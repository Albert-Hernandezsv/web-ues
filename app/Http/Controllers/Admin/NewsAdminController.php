<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsAdminController extends Controller
{
    public function index(): View
    {
        $newsItems = News::orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.news.index', compact('newsItems'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $news = new News();
        $news->title = $validated['title'];
        $news->slug = Str::slug($validated['title']);

        if (News::where('slug', $news->slug)->exists()) {
            $news->slug = $news->slug . '-' . time();
        }

        $news->summary = $validated['summary'] ?? null;
        $news->content = $validated['content'] ?? null;
        $news->published_at = $validated['published_at'] ?? null;
        $news->status = (bool) $validated['status'];

        if ($request->hasFile('image')) {
            $news->image = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Noticia creada correctamente.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $newSlug = Str::slug($validated['title']);

        if (News::where('slug', $newSlug)->where('id', '!=', $news->id)->exists()) {
            $newSlug = $newSlug . '-' . time();
        }

        $news->title = $validated['title'];
        $news->slug = $newSlug;
        $news->summary = $validated['summary'] ?? null;
        $news->content = $validated['content'] ?? null;
        $news->published_at = $validated['published_at'] ?? null;
        $news->status = (bool) $validated['status'];

        if ($request->hasFile('image')) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $news->image = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Noticia eliminada correctamente.');
    }
}
