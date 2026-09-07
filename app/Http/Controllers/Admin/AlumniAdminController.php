<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AlumniAdminController extends Controller
{
    public function index(): View
    {
        $alumnis = Alumni::orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.alumnis.index', compact('alumnis'));
    }

    public function create(): View
    {
        return view('admin.alumnis.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'headline' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $alumni = new Alumni();
        $alumni->name = $validated['name'];
        $alumni->slug = Str::slug($validated['name']);

        if (Alumni::where('slug', $alumni->slug)->exists()) {
            $alumni->slug .= '-' . time();
        }

        $alumni->headline = $validated['headline'] ?? null;
        $alumni->company = $validated['company'] ?? null;
        $alumni->summary = $validated['summary'] ?? null;
        $alumni->content = $validated['content'] ?? null;
        $alumni->published_at = $validated['published_at'] ?? null;
        $alumni->status = (bool) $validated['status'];

        if ($request->hasFile('image')) {
            $alumni->image = $request->file('image')->store('alumnis', 'public');
        }

        $alumni->save();

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Caso de éxito creado correctamente.');
    }

    public function edit(Alumni $alumni): View
    {
        return view('admin.alumnis.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'headline' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $newSlug = Str::slug($validated['name']);

        if (Alumni::where('slug', $newSlug)->where('id', '!=', $alumni->id)->exists()) {
            $newSlug .= '-' . time();
        }

        $alumni->name = $validated['name'];
        $alumni->slug = $newSlug;
        $alumni->headline = $validated['headline'] ?? null;
        $alumni->company = $validated['company'] ?? null;
        $alumni->summary = $validated['summary'] ?? null;
        $alumni->content = $validated['content'] ?? null;
        $alumni->published_at = $validated['published_at'] ?? null;
        $alumni->status = (bool) $validated['status'];

        if ($request->hasFile('image')) {
            if ($alumni->image && Storage::disk('public')->exists($alumni->image)) {
                Storage::disk('public')->delete($alumni->image);
            }
            $alumni->image = $request->file('image')->store('alumnis', 'public');
        }

        $alumni->save();

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Caso de éxito actualizado correctamente.');
    }

    public function destroy(Alumni $alumni): RedirectResponse
    {
        if ($alumni->image && Storage::disk('public')->exists($alumni->image)) {
            Storage::disk('public')->delete($alumni->image);
        }

        $alumni->delete();

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Caso de éxito eliminado correctamente.');
    }
}
