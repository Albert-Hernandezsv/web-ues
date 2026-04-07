<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Page;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'alumnis')
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $alumnis = Alumni::where('status', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.alumnis.index', compact('page', 'sections', 'alumnis'));
    }

    public function show(string $slug): View
    {
        $alumni = Alumni::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('pages.alumnis.show', compact('alumni'));
    }
}
