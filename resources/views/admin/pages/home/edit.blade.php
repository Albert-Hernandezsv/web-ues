<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar página de inicio
        </h2>
    </x-slot>

    @php
        $homeInfo = $sections['home_info'] ?? null;
        $homePlan = $sections['home_plan'] ?? null;
        $homeNews = $sections['home_news'] ?? null;
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pages.home.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Slider principal</h3>

                    <div class="space-y-8">
                        @foreach($sliderItems as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Slide #{{ $loop->iteration }}</h4>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                        <input type="text"
                                               name="slider[{{ $item->id }}][title]"
                                               value="{{ old('slider.' . $item->id . '.title', $item->title) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtítulo</label>
                                        <input type="text"
                                               name="slider[{{ $item->id }}][subtitle]"
                                               value="{{ old('slider.' . $item->id . '.subtitle', $item->subtitle) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                                        <input type="text"
                                               name="slider[{{ $item->id }}][link]"
                                               value="{{ old('slider.' . $item->id . '.link', $item->link) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                                        <input type="number"
                                               min="1"
                                               name="slider[{{ $item->id }}][sort_order]"
                                               value="{{ old('slider.' . $item->id . '.sort_order', $item->sort_order) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                                        <input type="file"
                                               name="slider_images[{{ $item->id }}]"
                                               accept=".jpg,.jpeg,.png,.webp"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">

                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 alt="Slide {{ $loop->iteration }}"
                                                 class="mt-4 h-40 w-full max-w-md object-cover rounded-xl border">
                                        @endif
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="slider[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox"
                                                   name="slider[{{ $item->id }}][status]"
                                                   value="1"
                                                   {{ old('slider.' . $item->id . '.status', $item->status) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Sección informativa</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="home_info_title" value="{{ old('home_info_title', $homeInfo->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="home_info_content" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('home_info_content', $homeInfo->content ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen superior</label>
                            <input type="file" name="home_info_image_1" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                            @if(!empty($homeInfo?->image_1))
                                <img src="{{ asset('storage/' . $homeInfo->image_1) }}" class="mt-4 h-40 w-full object-cover rounded-xl border">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link imagen superior</label>
                            <input type="text" name="home_info_image_1_link" value="{{ old('home_info_image_1_link', $homeInfo->image_1_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen inferior</label>
                            <input type="file" name="home_info_image_2" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                            @if(!empty($homeInfo?->image_2))
                                <img src="{{ asset('storage/' . $homeInfo->image_2) }}" class="mt-4 h-40 w-full object-cover rounded-xl border">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link imagen inferior</label>
                            <input type="text" name="home_info_image_2_link" value="{{ old('home_info_image_2_link', $homeInfo->image_2_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Resumen plan de estudios</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="home_plan_title" value="{{ old('home_plan_title', $homePlan->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="home_plan_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('home_plan_content', $homePlan->content ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Punto 1</label>
                            <input type="text" name="home_plan_extra_1" value="{{ old('home_plan_extra_1', $homePlan->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Punto 2</label>
                            <input type="text" name="home_plan_extra_2" value="{{ old('home_plan_extra_2', $homePlan->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Punto 3</label>
                            <input type="text" name="home_plan_extra_3" value="{{ old('home_plan_extra_3', $homePlan->extra_3 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Texto del botón</label>
                            <input type="text" name="home_plan_button_text" value="{{ old('home_plan_button_text', $homePlan->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link del botón</label>
                            <input type="text" name="home_plan_button_link" value="{{ old('home_plan_button_link', $homePlan->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Encabezado de noticias</h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="home_news_title" value="{{ old('home_news_title', $homeNews->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="home_news_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('home_news_content', $homeNews->content ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
<br><br>
                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-black hover:bg-blue-700 transition">
                        Guardar cambios
                    </button>

                    <a href="{{ route('admin.pages.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Volver
                    </a>
                </div>
                <br><br>
            </form>
        </div>
    </div>
</x-app-layout>
