<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSectionItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PerfilEgresadoPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'perfil_egresado')->firstOrFail();

        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.perfil-egresado.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'perfil_egresado')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_content' => ['nullable', 'string'],

            'competencias_title' => ['nullable', 'string', 'max:255'],
            'competencias_content' => ['nullable', 'string'],

            'expectativas_title' => ['nullable', 'string', 'max:255'],
            'expectativas_content' => ['nullable', 'string'],

            'aspirante_title' => ['nullable', 'string', 'max:255'],
            'aspirante_content' => ['nullable', 'string'],

            'egresado_title' => ['nullable', 'string', 'max:255'],
            'egresado_content' => ['nullable', 'string'],
            'egresado_button_text' => ['nullable', 'string', 'max:100'],
            'egresado_button_link' => ['nullable', 'string', 'max:255'],

            'competencia_items' => ['nullable', 'array'],
            'competencia_items.*.title' => ['nullable', 'string', 'max:255'],
            'competencia_items.*.content' => ['nullable', 'string'],
            'competencia_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'competencia_items.*.status' => ['nullable', 'boolean'],

            'expectativa_items' => ['nullable', 'array'],
            'expectativa_items.*.title' => ['nullable', 'string', 'max:255'],
            'expectativa_items.*.content' => ['nullable', 'string'],
            'expectativa_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'expectativa_items.*.status' => ['nullable', 'boolean'],

            'aspirante_items' => ['nullable', 'array'],
            'aspirante_items.*.title' => ['nullable', 'string', 'max:255'],
            'aspirante_items.*.content' => ['nullable', 'string'],
            'aspirante_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'aspirante_items.*.status' => ['nullable', 'boolean'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_hero')->firstOrFail();
        $intro = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_intro')->firstOrFail();
        $competencias = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_competencias')->firstOrFail();
        $expectativas = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_expectativas')->firstOrFail();
        $aspirante = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_aspirante')->firstOrFail();
        $egresado = PageSection::where('page_id', $page->id)->where('section_key', 'perfil_egresado')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }
            $hero->image_1 = $request->file('hero_image')->store('sections/perfil', 'public');
        }
        $hero->save();

        $intro->title = $request->intro_title;
        $intro->content = $request->intro_content;
        $intro->save();

        $competencias->title = $request->competencias_title;
        $competencias->content = $request->competencias_content;
        $competencias->save();

        $expectativas->title = $request->expectativas_title;
        $expectativas->content = $request->expectativas_content;
        $expectativas->save();

        $aspirante->title = $request->aspirante_title;
        $aspirante->content = $request->aspirante_content;
        $aspirante->save();

        $egresado->title = $request->egresado_title;
        $egresado->content = $request->egresado_content;
        $egresado->button_text = $request->egresado_button_text;
        $egresado->button_link = $request->egresado_button_link;
        $egresado->save();

        foreach ($request->input('competencia_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $competencias->id)->where('id', $id)->first();
            if (!$row) continue;
            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;
            $row->save();
        }

        foreach ($request->input('expectativa_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $expectativas->id)->where('id', $id)->first();
            if (!$row) continue;
            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;
            $row->save();
        }

        foreach ($request->input('aspirante_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $aspirante->id)->where('id', $id)->first();
            if (!$row) continue;
            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;
            $row->save();
        }

        return redirect()
            ->route('admin.pages.perfil.edit')
            ->with('success', 'La pagina Egresados parte 1 se actualizo correctamente.');
    }
}
