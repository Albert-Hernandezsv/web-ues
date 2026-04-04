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

class PlanEstudioPageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'plan_estudio')->firstOrFail();

        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        return view('admin.pages.plan-estudio.edit', compact('page', 'sections'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'plan_estudio')->firstOrFail();

        $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_content' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_content' => ['nullable', 'string'],

            'summary_title' => ['nullable', 'string', 'max:255'],
            'summary_content' => ['nullable', 'string'],
            'summary_extra_1' => ['nullable', 'string', 'max:255'],
            'summary_extra_2' => ['nullable', 'string', 'max:255'],
            'summary_subtitle' => ['nullable', 'string', 'max:255'],

            'areas_title' => ['nullable', 'string', 'max:255'],
            'areas_content' => ['nullable', 'string'],

            'cycles_title' => ['nullable', 'string', 'max:255'],
            'cycles_content' => ['nullable', 'string'],

            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_content' => ['nullable', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:100'],
            'cta_button_link' => ['nullable', 'string', 'max:255'],

            'area_items' => ['nullable', 'array'],
            'area_items.*.title' => ['nullable', 'string', 'max:255'],
            'area_items.*.content' => ['nullable', 'string'],
            'area_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'area_items.*.status' => ['nullable', 'boolean'],

            'cycle_items' => ['nullable', 'array'],
            'cycle_items.*.title' => ['nullable', 'string', 'max:255'],
            'cycle_items.*.content' => ['nullable', 'string'],
            'cycle_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'cycle_items.*.status' => ['nullable', 'boolean'],
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'plan_hero')->firstOrFail();
        $intro = PageSection::where('page_id', $page->id)->where('section_key', 'plan_intro')->firstOrFail();
        $summary = PageSection::where('page_id', $page->id)->where('section_key', 'plan_summary')->firstOrFail();
        $areas = PageSection::where('page_id', $page->id)->where('section_key', 'plan_areas')->firstOrFail();
        $cycles = PageSection::where('page_id', $page->id)->where('section_key', 'plan_cycles')->firstOrFail();
        $cta = PageSection::where('page_id', $page->id)->where('section_key', 'plan_cta')->firstOrFail();

        $hero->title = $request->hero_title;
        $hero->subtitle = $request->hero_subtitle;
        $hero->content = $request->hero_content;

        if ($request->hasFile('hero_image')) {
            if ($hero->image_1 && Storage::disk('public')->exists($hero->image_1)) {
                Storage::disk('public')->delete($hero->image_1);
            }
            $hero->image_1 = $request->file('hero_image')->store('sections/plan', 'public');
        }
        $hero->save();

        $intro->title = $request->intro_title;
        $intro->content = $request->intro_content;
        $intro->save();

        $summary->title = $request->summary_title;
        $summary->content = $request->summary_content;
        $summary->extra_1 = $request->summary_extra_1;
        $summary->extra_2 = $request->summary_extra_2;
        $summary->subtitle = $request->summary_subtitle;
        $summary->save();

        $areas->title = $request->areas_title;
        $areas->content = $request->areas_content;
        $areas->save();

        $cycles->title = $request->cycles_title;
        $cycles->content = $request->cycles_content;
        $cycles->save();

        $cta->title = $request->cta_title;
        $cta->content = $request->cta_content;
        $cta->button_text = $request->cta_button_text;
        $cta->button_link = $request->cta_button_link;
        $cta->save();

        foreach ($request->input('area_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $areas->id)->where('id', $id)->first();
            if (!$row) continue;

            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;
            $row->save();
        }

        foreach ($request->input('cycle_items', []) as $id => $item) {
            $row = PageSectionItem::where('page_section_id', $cycles->id)->where('id', $id)->first();
            if (!$row) continue;

            $row->title = $item['title'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;
            $row->save();
        }

        return redirect()
            ->route('admin.pages.plan.edit')
            ->with('success', 'La página Plan de estudios se actualizó correctamente.');
    }
}
