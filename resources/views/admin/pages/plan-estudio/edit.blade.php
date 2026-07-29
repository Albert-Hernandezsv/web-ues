<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Plan de estudios
        </h2>
    </x-slot>

    @php
        $hero = $sections['plan_hero'] ?? null;
        $intro = $sections['plan_intro'] ?? null;
        $summary = $sections['plan_summary'] ?? null;
        $specializations = $sections['plan_especializaciones_intro'] ?? null;
        $specializationSubjects = $sections['plan_especializaciones_materias'] ?? null;
        $areas = $sections['plan_areas'] ?? null;
        $cycles = $sections['plan_cycles'] ?? null;
        $cta = $sections['plan_cta'] ?? null;
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

            <form action="{{ route('admin.pages.plan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Lineas de especializacion</h3>
                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titulo</label>
                            <input type="text" name="esp_intro_title" value="{{ old('esp_intro_title', $specializations->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>
                            <textarea name="esp_intro_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('esp_intro_content', $specializations->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach(($specializations?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Linea #{{ $loop->iteration }}</h4>
                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="esp_intro_items[{{ $item->id }}][title]" value="{{ old('esp_intro_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                                    <input type="text" name="esp_intro_items[{{ $item->id }}][subtitle]" value="{{ old('esp_intro_items.' . $item->id . '.subtitle', $item->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtitulo">
                                    <textarea name="esp_intro_items[{{ $item->id }}][content]" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('esp_intro_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    <input type="file" name="esp_intro_images[{{ $item->id }}]" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="h-40 w-full max-w-md object-cover rounded-xl border">
                                    @endif
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="esp_intro_items[{{ $item->id }}][sort_order]" value="{{ old('esp_intro_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">
                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="esp_intro_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="esp_intro_items[{{ $item->id }}][status]" value="1" {{ old('esp_intro_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Materias por linea</h3>
                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titulo</label>
                            <input type="text" name="esp_mat_title" value="{{ old('esp_mat_title', $specializationSubjects->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>
                            <textarea name="esp_mat_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('esp_mat_content', $specializationSubjects->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach(($specializationSubjects?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Linea #{{ $loop->iteration }}</h4>
                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="esp_mat_items[{{ $item->id }}][title]" value="{{ old('esp_mat_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                                    <input type="text" name="esp_mat_items[{{ $item->id }}][subtitle]" value="{{ old('esp_mat_items.' . $item->id . '.subtitle', $item->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtitulo">
                                    <textarea name="esp_mat_items[{{ $item->id }}][content]" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('esp_mat_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="esp_mat_items[{{ $item->id }}][sort_order]" value="{{ old('esp_mat_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">
                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="esp_mat_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="esp_mat_items[{{ $item->id }}][status]" value="1" {{ old('esp_mat_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Hero principal</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $hero->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subtítulo</label>
                            <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="hero_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('hero_content', $hero->content ?? '') }}</textarea>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen hero</label>
                            <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                            @if(!empty($hero?->image_1))
                                <img src="{{ asset('storage/' . $hero->image_1) }}" class="mt-4 h-56 w-full max-w-xl object-cover rounded-xl border">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Introducción</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="intro_title" value="{{ old('intro_title', $intro->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="intro_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('intro_content', $intro->content ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Resumen académico</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="summary_title" value="{{ old('summary_title', $summary->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="summary_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('summary_content', $summary->content ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dato 1</label>
                            <input type="text" name="summary_extra_1" value="{{ old('summary_extra_1', $summary->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dato 2</label>
                            <input type="text" name="summary_extra_2" value="{{ old('summary_extra_2', $summary->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dato 3</label>
                            <input type="text" name="summary_subtitle" value="{{ old('summary_subtitle', $summary->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Áreas de formación</h3>
                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="areas_title" value="{{ old('areas_title', $areas->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="areas_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('areas_content', $areas->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach(($areas?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Área #{{ $loop->iteration }}</h4>
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                        <input type="text" name="area_items[{{ $item->id }}][title]" value="{{ old('area_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                                        <textarea name="area_items[{{ $item->id }}][content]" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('area_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    </div>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                                            <input type="number" min="1" name="area_items[{{ $item->id }}][sort_order]" value="{{ old('area_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                                        </div>
                                        <div class="flex items-end">
                                            <label class="inline-flex items-center gap-2">
                                                <input type="hidden" name="area_items[{{ $item->id }}][status]" value="0">
                                                <input type="checkbox" name="area_items[{{ $item->id }}][status]" value="1" {{ old('area_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                                <span class="text-sm text-gray-700">Activo</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Malla por ciclos</h3>
                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="cycles_title" value="{{ old('cycles_title', $cycles->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="cycles_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('cycles_content', $cycles->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach(($cycles?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Ciclo #{{ $loop->iteration }}</h4>
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                        <input type="text" name="cycle_items[{{ $item->id }}][title]" value="{{ old('cycle_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                                        <textarea name="cycle_items[{{ $item->id }}][content]" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('cycle_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    </div>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                                            <input type="number" min="1" name="cycle_items[{{ $item->id }}][sort_order]" value="{{ old('cycle_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                                        </div>
                                        <div class="flex items-end">
                                            <label class="inline-flex items-center gap-2">
                                                <input type="hidden" name="cycle_items[{{ $item->id }}][status]" value="0">
                                                <input type="checkbox" name="cycle_items[{{ $item->id }}][status]" value="1" {{ old('cycle_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                                <span class="text-sm text-gray-700">Activo</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">CTA final</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="cta_title" value="{{ old('cta_title', $cta->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="cta_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('cta_content', $cta->content ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Texto botón</label>
                            <input type="text" name="cta_button_text" value="{{ old('cta_button_text', $cta->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link botón</label>
                            <input type="text" name="cta_button_link" value="{{ old('cta_button_link', $cta->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Guardar cambios
                    </button>

                    <a href="{{ route('admin.pages.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
