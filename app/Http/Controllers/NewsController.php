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

        $newsItems = News::where('status', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.news.index', compact('page', 'sections', 'newsItems'));
    }

    public function show(string $slug): View
    {
        $news = News::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('pages.news.show', compact('news'));
    }
}
