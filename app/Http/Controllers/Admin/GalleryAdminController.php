<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryAdminController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::orderBy('sort_order')
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['nullable', 'date'],
            'media_type' => ['required', 'in:image,video'],
            'external_url' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'boolean'],
            'file' => ['nullable', 'file', 'max:20480'],
        ]);

        $gallery = new Gallery();
        $gallery->title = $validated['title'];
        $gallery->subtitle = $validated['subtitle'] ?? null;
        $gallery->location = $validated['location'] ?? null;
        $gallery->event_date = $validated['event_date'] ?? null;
        $gallery->media_type = $validated['media_type'];
        $gallery->external_url = $validated['external_url'] ?? null;
        $gallery->sort_order = $validated['sort_order'];
        $gallery->status = (bool) $validated['status'];

        if ($request->hasFile('file')) {
            $gallery->file_path = $request->file('file')->store('gallery', 'public');
        }

        $gallery->save();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Elemento de galería creado correctamente.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['nullable', 'date'],
            'media_type' => ['required', 'in:image,video'],
            'external_url' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'boolean'],
            'file' => ['nullable', 'file', 'max:20480'],
        ]);

        $gallery->title = $validated['title'];
        $gallery->subtitle = $validated['subtitle'] ?? null;
        $gallery->location = $validated['location'] ?? null;
        $gallery->event_date = $validated['event_date'] ?? null;
        $gallery->media_type = $validated['media_type'];
        $gallery->external_url = $validated['external_url'] ?? null;
        $gallery->sort_order = $validated['sort_order'];
        $gallery->status = (bool) $validated['status'];

        if ($request->hasFile('file')) {
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $gallery->file_path = $request->file('file')->store('gallery', 'public');
        }

        $gallery->save();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Elemento de galería actualizado correctamente.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Elemento de galería eliminado correctamente.');
    }
}
