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
use Illuminate\Validation\ValidationException;

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
            'hero_title' => ['required', 'string', 'max:80'],
            'hero_subtitle' => ['nullable', 'string', 'max:80'],
            'hero_content' => ['required', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'intro_title' => ['required', 'string', 'max:80'],
            'intro_content' => ['required', 'string'],

            'trabajos_title' => ['required', 'string', 'max:80'],
            'trabajos_content' => ['required', 'string'],

            'ss_intro_title' => ['required', 'string', 'max:80'],
            'ss_intro_content' => ['required', 'string'],
            'ss_intro_extra_1' => ['nullable', 'string', 'max:255'],
            'ss_intro_extra_2' => ['nullable', 'string', 'max:255'],

            'ss_req_title' => ['required', 'string', 'max:80'],
            'ss_req_content' => ['required', 'string'],

            'ss_obj_title' => ['required', 'string', 'max:80'],
            'ss_obj_content' => ['required', 'string'],

            'ss_mod_title' => ['required', 'string', 'max:80'],
            'ss_mod_content' => ['required', 'string'],

            'ss_pas_title' => ['required', 'string', 'max:80'],
            'ss_pas_content' => ['required', 'string'],

            'cta_title' => ['required', 'string', 'max:80'],
            'cta_content' => ['required', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:100'],
            'cta_button_link' => ['nullable', 'string', 'max:255'],

            'trabajo_items' => ['nullable', 'array'],
            'trabajo_items.*.title' => ['required_if:trabajo_items.*.status,1', 'nullable', 'string', 'max:80'],
            'trabajo_items.*.content' => ['nullable', 'string'],
            'trabajo_images' => ['nullable', 'array'],
            'trabajo_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'trabajo_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'trabajo_items.*.status' => ['nullable', 'boolean'],

            'ss_req_items' => ['nullable', 'array'],
            'ss_req_items.*.title' => ['required_if:ss_req_items.*.status,1', 'nullable', 'string', 'max:80'],
            'ss_req_items.*.subtitle' => ['nullable', 'string', 'max:80'],
            'ss_req_items.*.content' => ['nullable', 'string'],
            'ss_req_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'ss_req_items.*.status' => ['nullable', 'boolean'],

            'ss_obj_items' => ['nullable', 'array'],
            'ss_obj_items.*.title' => ['required_if:ss_obj_items.*.status,1', 'nullable', 'string', 'max:80'],
            'ss_obj_items.*.content' => ['nullable', 'string'],
            'ss_obj_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'ss_obj_items.*.status' => ['nullable', 'boolean'],

            'ss_mod_items' => ['nullable', 'array'],
            'ss_mod_items.*.title' => ['required_if:ss_mod_items.*.status,1', 'nullable', 'string', 'max:80'],
            'ss_mod_items.*.content' => ['nullable', 'string'],
            'ss_mod_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'ss_mod_items.*.status' => ['nullable', 'boolean'],

            'ss_pas_items' => ['nullable', 'array'],
            'ss_pas_items.*.title' => ['required_if:ss_pas_items.*.status,1', 'nullable', 'string', 'max:80'],
            'ss_pas_items.*.content' => ['nullable', 'string'],
            'ss_pas_items.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'ss_pas_items.*.status' => ['nullable', 'boolean'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'required_if' => 'El campo :attribute es obligatorio cuando el elemento está activo.',
        ]);

        $hero = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_hero')->firstOrFail();
        $intro = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_intro')->firstOrFail();
        $trabajos = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_trabajos_grado')->firstOrFail();
        $ssIntro = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social_intro')->firstOrFail();
        $ssReq = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social_requisitos')->firstOrFail();
        $ssObj = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social_objetivos')->firstOrFail();
        $ssMod = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social_modalidades')->firstOrFail();
        $ssPas = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_servicio_social_pasos')->firstOrFail();
        $cta = PageSection::where('page_id', $page->id)->where('section_key', 'preegreso_cta')->firstOrFail();

        // Resolve every submitted ID within its section before any database or file writes.
        $itemSections = [
            'trabajo_items' => $trabajos,
            'ss_req_items' => $ssReq,
            'ss_obj_items' => $ssObj,
            'ss_mod_items' => $ssMod,
            'ss_pas_items' => $ssPas,
        ];
        $itemRows = [];
        foreach ($itemSections as $field => $section) {
            $ids = array_keys($request->input($field) ?? []);
            if ($field === 'trabajo_items') {
                $ids = array_unique(array_merge($ids, array_keys($request->file('trabajo_images') ?? [])));
            }
            foreach ($ids as $id) {
                if (!preg_match('/^[1-9][0-9]*$/D', (string) $id)) {
                    throw ValidationException::withMessages([$field => 'El identificador del elemento no es válido.']);
                }
            }
            $rows = PageSectionItem::where('page_section_id', $section->id)
                ->whereIn('id', $ids)->get()->keyBy('id');
            if ($rows->count() !== count($ids)) {
                throw ValidationException::withMessages([
                    $field => 'Uno o más elementos no pertenecen a esta sección o ya no existen.',
                ]);
            }
            $itemRows[$field] = $rows;
        }
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

        $trabajos->title = $request->trabajos_title;
        $trabajos->content = $request->trabajos_content;
        $trabajos->save();

        $ssIntro->title = $request->ss_intro_title;
        $ssIntro->content = $request->ss_intro_content;
        $ssIntro->extra_1 = $request->ss_intro_extra_1;
        $ssIntro->extra_2 = $request->ss_intro_extra_2;
        $ssIntro->save();

        $ssReq->title = $request->ss_req_title;
        $ssReq->content = $request->ss_req_content;
        $ssReq->save();

        $ssObj->title = $request->ss_obj_title;
        $ssObj->content = $request->ss_obj_content;
        $ssObj->save();

        $ssMod->title = $request->ss_mod_title;
        $ssMod->content = $request->ss_mod_content;
        $ssMod->save();

        $ssPas->title = $request->ss_pas_title;
        $ssPas->content = $request->ss_pas_content;
        $ssPas->save();

        $cta->title = $request->cta_title;
        $cta->content = $request->cta_content;
        $cta->button_text = $request->cta_button_text;
        $cta->button_link = $request->cta_button_link;
        $cta->save();

        $this->updateItems($request, 'trabajo_items', $itemRows['trabajo_items'], 'trabajo_images');
        $this->updateItems($request, 'ss_req_items', $itemRows['ss_req_items']);
        $this->updateItems($request, 'ss_obj_items', $itemRows['ss_obj_items']);
        $this->updateItems($request, 'ss_mod_items', $itemRows['ss_mod_items']);
        $this->updateItems($request, 'ss_pas_items', $itemRows['ss_pas_items']);

        return redirect()
            ->route('admin.pages.preegreso.edit')
            ->with('success', 'La pagina Egresados parte 2 se actualizo correctamente.');
    }

    private function updateItems(Request $request, string $field, \Illuminate\Support\Collection $rows, ?string $imageField = null): void
    {
        $items = ($request->input($field) ?? []);
        $images = $imageField ? $request->file($imageField, []) : [];

        foreach ($items as $id => $item) {
            $row = $rows->get($id);


            $row->title = $item['title'] ?? null;
            $row->subtitle = $item['subtitle'] ?? null;
            $row->content = $item['content'] ?? null;
            $row->extra_1 = $item['extra_1'] ?? null;
            $row->sort_order = $item['sort_order'] ?? 1;
            $row->status = isset($item['status']) ? (bool)$item['status'] : false;

            if ($imageField && isset($images[$id])) {
                if ($row->image && Storage::disk('public')->exists($row->image)) {
                    Storage::disk('public')->delete($row->image);
                }
                $row->image = $images[$id]->store('sections/preegresados', 'public');
            }

            $row->save();
        }
    }
}
