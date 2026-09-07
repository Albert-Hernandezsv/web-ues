<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlumnisPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'alumnis')->firstOrFail();

        $sections = $page->sections()
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.alumnis.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'alumnis')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_content' => ['nullable', 'string'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'alumnis_hero')->firstOrFail();
        $intro = PageSection::where('page_id', $page->id)->where('section_key', 'alumnis_intro')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }
            $hero->image_1 = $request->file('hero_image')->store('sections/alumnis', 'public');
        }

        $hero->save();

        $intro->title = $request->intro_title;
        $intro->content = $request->intro_content;
        $intro->save();

        return redirect()
            ->route('admin.pages.alumnis.edit')
            ->with('success', 'La página Alumnis se actualizó correctamente.');
    }
}
