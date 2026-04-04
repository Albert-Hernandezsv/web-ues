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

class IngresoPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'ingreso')->firstOrFail();

        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.ingreso.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'ingreso')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'periodo_title' => ['nullable', 'string', 'max:255'],
            'periodo_content' => ['nullable', 'string'],
            'periodo_extra_1' => ['nullable', 'string', 'max:255'],

            'steps_title' => ['nullable', 'string', 'max:255'],
            'steps_content' => ['nullable', 'string'],

            'recordatorio_title' => ['nullable', 'string', 'max:255'],
            'recordatorio_content' => ['nullable', 'string'],

            'contacto_title' => ['nullable', 'string', 'max:255'],
            'contacto_content' => ['nullable', 'string'],
            'contacto_button_text' => ['nullable', 'string', 'max:100'],
            'contacto_button_link' => ['nullable', 'string', 'max:255'],
            'contacto_extra_1' => ['nullable', 'string', 'max:255'],

            'steps_items' => ['nullable', 'array'],
            'steps_items.*.title' => ['nullable', 'string', 'max:255'],
            'steps_items.*.content' => ['nullable', 'string'],
            'steps_items.*.link' => ['nullable', 'string', 'max:255'],
            'steps_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'steps_items.*.status' => ['nullable', 'boolean'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'ingreso_hero')->firstOrFail();
        $periodo = PageSection::where('page_id', $page->id)->where('section_key', 'ingreso_periodo')->firstOrFail();
        $steps = PageSection::where('page_id', $page->id)->where('section_key', 'ingreso_steps')->firstOrFail();
        $recordatorio = PageSection::where('page_id', $page->id)->where('section_key', 'ingreso_recordatorio')->firstOrFail();
        $contacto = PageSection::where('page_id', $page->id)->where('section_key', 'ingreso_contacto')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }

            $hero->image_1 = $request->file('hero_image')->store('sections/ingreso', 'public');
        }

        $hero->save();

        $periodo->title = $request->periodo_title;
        $periodo->content = $request->periodo_content;
        $periodo->extra_1 = $request->periodo_extra_1;
        $periodo->save();

        $steps->title = $request->steps_title;
        $steps->content = $request->steps_content;
        $steps->save();

        $recordatorio->title = $request->recordatorio_title;
        $recordatorio->content = $request->recordatorio_content;
        $recordatorio->save();

        $contacto->title = $request->contacto_title;
        $contacto->content = $request->contacto_content;
        $contacto->button_text = $request->contacto_button_text;
        $contacto->button_link = $request->contacto_button_link;
        $contacto->extra_1 = $request->contacto_extra_1;
        $contacto->save();

        $stepsItems = $request->input('steps_items', []);

        foreach ($stepsItems as $id => $item) {
            $stepItem = PageSectionItem::where('page_section_id', $steps->id)
                ->where('id', $id)
                ->first();

            if (!$stepItem) {
                continue;
            }

            $stepItem->title = $item['title'] ?? null;
            $stepItem->content = $item['content'] ?? null;
            $stepItem->link = $item['link'] ?? null;
            $stepItem->sort_order = $item['sort_order'] ?? 1;
            $stepItem->status = isset($item['status']) ? (bool) $item['status'] : false;
            $stepItem->save();
        }

        return redirect()
            ->route('admin.pages.ingreso.edit')
            ->with('success', 'La página de ingreso se actualizó correctamente.');
    }
}
