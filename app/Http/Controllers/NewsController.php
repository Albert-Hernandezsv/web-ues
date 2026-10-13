<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'noticias')
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $newsItems = News::published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.news.index', compact('page', 'sections', 'newsItems'));
    }

    public function show(string $slug): View
    {
        $news = News::published()->where('slug', $slug)->first();

        // Legacy empty slugs get a usable link without changing stored content.
        if (!$news && preg_match('/^noticia-([1-9][0-9]*)(?:-respaldo)*$/D', $slug, $matches)) {
            $news = News::published()->whereKey($matches[1])
                ->where(function ($query) {
                    $query->whereNull('slug')->orWhereRaw("TRIM(slug) = ''");
                })->first();
        }
        abort_unless($news, 404);

        return view('pages.news.show', compact('news'));
    }
}
