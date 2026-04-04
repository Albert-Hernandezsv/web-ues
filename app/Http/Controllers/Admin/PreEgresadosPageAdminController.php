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

class PreEgresadosPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'pre-egresados')->firstOrFail();

        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.pre-egresados.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'pre-egresados')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_content' => ['nullable', 'string'],

            'especializaciones_title' => ['nullable', 'string', 'max:255'],
            'especializaciones_content' => ['nullable', 'string'],

            'trabajos_title' => ['nullable', 'string', 'max:255'],
            'trabajos_content' => ['nullable', 'string'],

            'servicio_title' => ['nullable', 'string', 'max:255'],
            'servicio_content' => ['nullable', 'string'],
            'servicio_extra_1' => ['nullable', 'string', 'max:255'],
            'servicio_extra_2' => ['nullable', 'string', 'max:255'],

            'pasos_title' => ['nullable', 'string', 'max:255'],
            'pasos_content' => ['nullable', 'string'],

            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_content' => ['nullable', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:100'],
            'cta_button_link' => ['nullable', 'string', 'max:255'],

            'especializacion_items' => ['nullable', 'array'],
            'especializacion_items.*.title' => ['nullable', 'string', 'max:255'],
            'especializacion_items.*.subtitle' => ['nullable', 'string', 'max:255'],
            'especializacion_items.*.content' => ['nullable', 'string'],
            'especializacion_items.*.extra_1' => ['nullable', 'string', 'max:255'],
            'especializacion_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'especializacion_items.*.status' => ['nullable', 'boolean'],

            'trabajo_items' => ['nullable', 'array'],
            'trabajo_items.*.title' => ['nullable', 'string', 'max:255'],
            'trabajo_items.*.content' => ['nullable', 'string'],
            'trabajo_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'trabajo_items.*.status' => ['nullable', 'boolean'],

            'servicio_items' => ['nullable', 'array'],
            'servicio_items.*.title' => ['nullable', 'string', 'max:255'],
            'servicio_items.*.subtitle' => ['nullable', 'string', 'max:255'],
            'servicio_items.*.content' => ['nullable', 'string'],
            'servicio_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'servicio_items.*.status' => ['nullable', 'boolean'],

            'paso_items' => ['nullable', 'array'],
            'paso_items.*.title' => ['nullable', 'string', 'max:255'],
            'paso_items.*.content' => ['nullable', 'string'],
            'paso_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'paso_items.*.status' => ['nullable', 'boolean'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_hero')->firstOrFail();
        $intro = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_intro')->firstOrFail();
        $especializaciones = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_especializaciones')->firstOrFail();
        $trabajos = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_trabajos_grado')->firstOrFail();
        $servicio = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social')->firstOrFail();
        $pasos = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_pasos')->firstOrFail();
        $cta = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_cta')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }

            $hero->image_1 = $request->file('hero_image')->store('sections/preegresados', 'public');
        }

        $hero->save();

        $intro->title = $request->intro_title;
        $intro->content = $request->intro_content;
        $intro->save();

        $especializaciones->title = $request->especializaciones_title;
        $especializaciones->content = $request->especializaciones_content;
        $especializaciones->save();

        $trabajos->title = $request->trabajos_title;
        $trabajos->content = $request->trabajos_content;
        $trabajos->save();

        $servicio->title = $request->servicio_title;
        $servicio->content = $request->servicio_content;
        $servicio->extra_1 = $request->servicio_extra_1;
        $servicio->extra_2 = $request->servicio_extra_2;
        $servicio->save();

        $pasos->title = $request->pasos_title;
        $pasos->content = $request->pasos_content;
        $pasos->save();

        $cta->title = $request->cta_title;
        $cta->content = $request->cta_content;
        $cta->button_text = $request->cta_button_text;
        $cta->button_link = $request->cta_button_link;
        $cta->save();

        foreach ($request->input('especializacion_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $especializaciones->id)
                ->where('id', $id)
                ->first();

            if (!$row) {
                continue;
            }

            $row->title = $item['title'] ?? null;
            $row->subtitle = $item['subtitle'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->extra_1 = $item['extra_1'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool) $item['status'] : false;
            $row->save();
        }

        foreach ($request->input('trabajo_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $trabajos->id)
                ->where('id', $id)
                ->first();

            if (!$row) {
                continue;
            }

            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool) $item['status'] : false;
            $row->save();
        }

        foreach ($request->input('servicio_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $servicio->id)
                ->where('id', $id)
                ->first();

            if (!$row) {
                continue;
            }

            $row->title = $item['title'] ?? null;
            $row->subtitle = $item['subtitle'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool) $item['status'] : false;
            $row->save();
        }

        foreach ($request->input('paso_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $pasos->id)
                ->where('id', $id)
                ->first();

            if (!$row) {
                continue;
            }

            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool) $item['status'] : false;
            $row->save();
        }

        return redirect()
            ->route('admin.pages.preegreso.edit')
            ->with('success', 'La página Pre-egresados se actualizó correctamente.');
    }
}
