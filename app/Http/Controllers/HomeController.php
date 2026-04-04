<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'inicio')
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $sliderItems = $page->sliderItems()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get();

        $news = News::where('status', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        return view('pages.home', compact('page', 'sections', 'sliderItems', 'news'));
    }

    public function show(string $slug): View{
        $page = Page::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->where('status', true)->orderBy('sort_order');
            }])
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        if ($slug === 'ingreso') {
            return view('pages.ingreso', compact('page', 'sections'));
        }

        if ($slug === 'plan_estudio') {
            return view('pages.plan-estudio', compact('page', 'sections'));
        }

        if ($slug === 'perfil_egresado') {
            return view('pages.perfil-egresado', compact('page', 'sections'));
        }

        if ($slug === 'contacto') {
            return view('pages.contacto', compact('page', 'sections'));
        }

        if ($slug === 'descargas') {
            return view('pages.descargas', compact('page', 'sections'));
        }

        if ($slug === 'pre-egresados') {
            return view('pages.pre-egresados', compact('page', 'sections'));
        }

        return view('pages.generic', compact('page', 'sections'));
    }


}
