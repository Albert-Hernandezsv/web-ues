<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSliderItem;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomePageAdminController extends Controller
{
    public function edit(): View
    {
        $page = Page::where('slug', 'inicio')->firstOrFail();

        $sections = $page->sections()->get()->keyBy('section_key');
        $sliderItems = $page->sliderItems()->orderBy('sort_order')->get();

        return view('admin.pages.home.edit', compact('page', 'sections', 'sliderItems'));
    }

    public function update(Request $request): RedirectResponse
    {
        $page = Page::where('slug', 'inicio')->firstOrFail();

        $request->validate([
            'home_info_title' => ['nullable', 'string', 'max:255'],
            'home_info_content' => ['nullable', 'string'],
            'home_info_image_1_link' => ['nullable', 'string', 'max:255'],
            'home_info_image_2_link' => ['nullable', 'string', 'max:255'],

            'home_plan_title' => ['nullable', 'string', 'max:255'],
            'home_plan_content' => ['nullable', 'string'],
            'home_plan_extra_1' => ['nullable', 'string', 'max:255'],
            'home_plan_extra_2' => ['nullable', 'string', 'max:255'],
            'home_plan_extra_3' => ['nullable', 'string', 'max:255'],
            'home_plan_button_text' => ['nullable', 'string', 'max:100'],
            'home_plan_button_link' => ['nullable', 'string', 'max:255'],

            'home_news_title' => ['nullable', 'string', 'max:255'],
            'home_news_content' => ['nullable', 'string'],

            'slider.*.title' => ['nullable', 'string', 'max:255'],
            'slider.*.subtitle' => ['nullable', 'string', 'max:255'],
            'slider.*.link' => ['nullable', 'string', 'max:255'],
            'slider.*.sort_order' => ['nullable', 'integer', 'min:1'],
            'slider.*.status' => ['nullable', 'boolean'],

            'slider_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'home_info_image_1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'home_info_image_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $homeInfo = PageSection::where('page_id', $page->id)->where('section_key', 'home_info')->firstOrFail();
        $homePlan = PageSection::where('page_id', $page->id)->where('section_key', 'home_plan')->firstOrFail();
        $homeNews = PageSection::where('page_id', $page->id)->where('section_key', 'home_news')->firstOrFail();

        $homeInfo->title = $request->home_info_title;
        $homeInfo->content = $request->home_info_content;
        $homeInfo->image_1_link = $request->home_info_image_1_link;
        $homeInfo->image_2_link = $request->home_info_image_2_link;

        if ($request->hasFile('home_info_image_1')) {
            if ($homeInfo->image_1 && Storage::disk('public')->exists($homeInfo->image_1)) {
                Storage::disk('public')->delete($homeInfo->image_1);
            }

            $homeInfo->image_1 = $request->file('home_info_image_1')->store('sections/home', 'public');
        }

        if ($request->hasFile('home_info_image_2')) {
            if ($homeInfo->image_2 && Storage::disk('public')->exists($homeInfo->image_2)) {
                Storage::disk('public')->delete($homeInfo->image_2);
            }

            $homeInfo->image_2 = $request->file('home_info_image_2')->store('sections/home', 'public');
        }

        $homeInfo->save();

        $homePlan->title = $request->home_plan_title;
        $homePlan->content = $request->home_plan_content;
        $homePlan->extra_1 = $request->home_plan_extra_1;
        $homePlan->extra_2 = $request->home_plan_extra_2;
        $homePlan->extra_3 = $request->home_plan_extra_3;
        $homePlan->button_text = $request->home_plan_button_text;
        $homePlan->button_link = $request->home_plan_button_link;
        $homePlan->save();

        $homeNews->title = $request->home_news_title;
        $homeNews->content = $request->home_news_content;
        $homeNews->save();

        $sliderData = $request->input('slider', []);
        $sliderImages = $request->file('slider_images', []);

        foreach ($sliderData as $id => $item) {
            $sliderItem = HomeSliderItem::where('page_id', $page->id)->where('id', $id)->first();

            if (!$sliderItem) {
                continue;
            }

            $sliderItem->title = $item['title'] ?? null;
            $sliderItem->subtitle = $item['subtitle'] ?? null;
            $sliderItem->link = $item['link'] ?? null;
            $sliderItem->sort_order = $item['sort_order'] ?? 1;
            $sliderItem->status = isset($item['status']) ? (bool) $item['status'] : false;

            if (isset($sliderImages[$id])) {
                if ($sliderItem->image && Storage::disk('public')->exists($sliderItem->image)) {
                    Storage::disk('public')->delete($sliderItem->image);
                }

                $sliderItem->image = $sliderImages[$id]->store('slider', 'public');
            }

            $sliderItem->save();
        }

        return redirect()
            ->route('admin.pages.home.edit')
            ->with('success', 'La página de inicio se actualizó correctamente.');
    }
}
