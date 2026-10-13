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

        $alumnis = Alumni::published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.alumnis.index', compact('page', 'sections', 'alumnis'));
    }

    public function show(string $slug): View
    {
        $alumni = Alumni::published()->where('slug', $slug)->first();

        // Legacy empty slugs get a usable link without changing stored content.
        if (!$alumni && preg_match('/^alumni-([1-9][0-9]*)(?:-respaldo)*$/D', $slug, $matches)) {
            $alumni = Alumni::published()->whereKey($matches[1])
                ->where(function ($query) {
                    $query->whereNull('slug')->orWhereRaw("TRIM(slug) = ''");
                })->first();
        }
        abort_unless($alumni, 404);

        return view('pages.alumnis.show', compact('alumni'));
    }
}
