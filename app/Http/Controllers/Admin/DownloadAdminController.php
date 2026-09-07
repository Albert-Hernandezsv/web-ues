<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DownloadAdminController extends Controller
{
    public function index(): View
    {
        $downloads = Download::orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.downloads.index', compact('downloads'));
    }

    public function create(): View
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'boolean'],
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx',
                'max:10240'
            ],
        ]);

        $download = new Download();
        $download->title = $validated['title'];
        $download->description = $validated['description'] ?? null;
        $download->sort_order = $validated['sort_order'];
        $download->status = (bool) $validated['status'];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $download->file_path = $file->store('downloads', 'public');
            $download->file_type = strtolower($file->getClientOriginalExtension());
        }

        $download->save();

        return redirect()
            ->route('admin.downloads.index')
            ->with('success', 'Archivo creado correctamente.');
    }

    public function edit(Download $download): View
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'boolean'],
            'file' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx',
                'max:10240'
            ],
        ]);

        $download->title = $validated['title'];
        $download->description = $validated['description'] ?? null;
        $download->sort_order = $validated['sort_order'];
        $download->status = (bool) $validated['status'];

        if ($request->hasFile('file')) {
            if ($download->file_path && Storage::disk('public')->exists($download->file_path)) {
                Storage::disk('public')->delete($download->file_path);
            }

            $file = $request->file('file');
            $download->file_path = $file->store('downloads', 'public');
            $download->file_type = strtolower($file->getClientOriginalExtension());
        }

        $download->save();

        return redirect()
            ->route('admin.downloads.index')
            ->with('success', 'Archivo actualizado correctamente.');
    }

    public function destroy(Download $download): RedirectResponse
    {
        if ($download->file_path && Storage::disk('public')->exists($download->file_path)) {
            Storage::disk('public')->delete($download->file_path);
        }

        $download->delete();

        return redirect()
            ->route('admin.downloads.index')
            ->with('success', 'Archivo eliminado correctamente.');
    }
}
