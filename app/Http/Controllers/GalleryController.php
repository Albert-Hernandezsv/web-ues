<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'galeria')
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $galleries = Gallery::where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.galeria.index', compact('page', 'sections', 'galleries'));
    }
}
