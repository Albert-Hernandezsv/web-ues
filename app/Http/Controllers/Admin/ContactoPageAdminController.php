<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContactoPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'contacto')->firstOrFail();

        $sections = $page->sections()
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.contacto.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'contacto')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'info_title' => ['nullable', 'string', 'max:255'],
            'info_content' => ['nullable', 'string'],
            'info_phone' => ['nullable', 'string', 'max:255'],
            'info_email' => ['nullable', 'string', 'max:255'],

            'social_title' => ['nullable', 'string', 'max:255'],
            'social_content' => ['nullable', 'string'],
            'social_button_text' => ['nullable', 'string', 'max:100'],
            'social_button_link' => ['nullable', 'string', 'max:255'],

            'maps_title' => ['nullable', 'string', 'max:255'],
            'maps_content' => ['nullable', 'string'],
            'maps_button_text' => ['nullable', 'string', 'max:100'],
            'maps_button_link' => ['nullable', 'string', 'max:1000'],

            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_content' => ['nullable', 'string'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'contacto_hero')->firstOrFail();
        $info = PageSection::where('page_id', $page->id)->where('section_key', 'contacto_info')->firstOrFail();
        $social = PageSection::where('page_id', $page->id)->where('section_key', 'contacto_social')->firstOrFail();
        $maps = PageSection::where('page_id', $page->id)->where('section_key', 'contacto_maps')->firstOrFail();
        $cta = PageSection::where('page_id', $page->id)->where('section_key', 'contacto_cta')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }
            $hero->image_1 = $request->file('hero_image')->store('sections/contacto', 'public');
        }
        $hero->save();

        $info->title = $request->info_title;
        $info->content = $request->info_content;
        $info->extra_1 = $request->info_phone;
        $info->extra_2 = $request->info_email;
        $info->save();

        $social->title = $request->social_title;
        $social->content = $request->social_content;
        $social->button_text = $request->social_button_text;
        $social->button_link = $request->social_button_link;
        $social->save();

        $maps->title = $request->maps_title;
        $maps->content = $request->maps_content;
        $maps->button_text = $request->maps_button_text;
        $maps->button_link = $request->maps_button_link;
        $maps->save();

        $cta->title = $request->cta_title;
        $cta->content = $request->cta_content;
        $cta->save();

        return redirect()
            ->route('admin.pages.contacto.edit')
            ->with('success', 'La página Contacto se actualizó correctamente.');
    }
}
