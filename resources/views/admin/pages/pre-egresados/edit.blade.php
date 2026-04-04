<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Pre-egresados
        </h2>
    </x-slot>

    @php
        $hero = $sections['preegreso_hero'] ?? null;
        $intro = $sections['preegreso_intro'] ?? null;
        $especializaciones = $sections['preegreso_especializaciones'] ?? null;
        $trabajos = $sections['preegreso_trabajos_grado'] ?? null;
        $servicio = $sections['preegreso_servicio_social'] ?? null;
        $pasos = $sections['preegreso_servicio_pasos'] ?? null;
        $cta = $sections['preegreso_cta'] ?? null;
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

            <form action="{{ route('admin.pages.preegreso.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Hero principal</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="hero_title" value="{{ old('hero_title', $hero->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo">
                        <textarea name="hero_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('hero_content', $hero->content ?? '') }}</textarea>
                        <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                        @if(!empty($hero?->image_1))
                            <img src="{{ asset('storage/' . $hero->image_1) }}" class="h-56 w-full max-w-xl object-cover rounded-xl border">
                        @endif
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Introducción</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="intro_title" value="{{ old('intro_title', $intro->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="intro_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('intro_content', $intro->content ?? '') }}</textarea>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Líneas de especialización</h3>

                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <input type="text" name="especializaciones_title" value="{{ old('especializaciones_title', $especializaciones->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="especializaciones_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Descripción">{{ old('especializaciones_content', $especializaciones->content ?? '') }}</textarea>
                    </div>

                    <div class="space-y-6">
                        @foreach(($especializaciones?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Especialización / bloque #{{ $loop->iteration }}</h4>

                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="especializacion_items[{{ $item->id }}][title]" value="{{ old('especializacion_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                                    <input type="text" name="especializacion_items[{{ $item->id }}][subtitle]" value="{{ old('especializacion_items.' . $item->id . '.subtitle', $item->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo">
                                    <textarea name="especializacion_items[{{ $item->id }}][content]" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('especializacion_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    <input type="text" name="especializacion_items[{{ $item->id }}][extra_1]" value="{{ old('especializacion_items.' . $item->id . '.extra_1', $item->extra_1) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Nota adicional">

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="especializacion_items[{{ $item->id }}][sort_order]" value="{{ old('especializacion_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">

                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="especializacion_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="especializacion_items[{{ $item->id }}][status]" value="1" {{ old('especializacion_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Trabajos de grado</h3>

                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <input type="text" name="trabajos_title" value="{{ old('trabajos_title', $trabajos->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="trabajos_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Descripción">{{ old('trabajos_content', $trabajos->content ?? '') }}</textarea>
                    </div>

                    <div class="space-y-6">
                        @foreach(($trabajos?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="trabajo_items[{{ $item->id }}][title]" value="{{ old('trabajo_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                                    <textarea name="trabajo_items[{{ $item->id }}][content]" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('trabajo_items.' . $item->id . '.content', $item->content) }}</textarea>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="trabajo_items[{{ $item->id }}][sort_order]" value="{{ old('trabajo_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">

                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="trabajo_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="trabajo_items[{{ $item->id }}][status]" value="1" {{ old('trabajo_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Servicio social</h3>

                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <input type="text" name="servicio_title" value="{{ old('servicio_title', $servicio->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="servicio_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Descripción">{{ old('servicio_content', $servicio->content ?? '') }}</textarea>
                        <input type="text" name="servicio_extra_1" value="{{ old('servicio_extra_1', $servicio->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Dato destacado 1">
                        <input type="text" name="servicio_extra_2" value="{{ old('servicio_extra_2', $servicio->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Dato destacado 2">
                    </div>

                    <div class="space-y-6">
                        @foreach(($servicio?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="servicio_items[{{ $item->id }}][title]" value="{{ old('servicio_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                                    <input type="text" name="servicio_items[{{ $item->id }}][subtitle]" value="{{ old('servicio_items.' . $item->id . '.subtitle', $item->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo">
                                    <textarea name="servicio_items[{{ $item->id }}][content]" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('servicio_items.' . $item->id . '.content', $item->content) }}</textarea>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="servicio_items[{{ $item->id }}][sort_order]" value="{{ old('servicio_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">

                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="servicio_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="servicio_items[{{ $item->id }}][status]" value="1" {{ old('servicio_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Pasos del trámite</h3>

                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <input type="text" name="pasos_title" value="{{ old('pasos_title', $pasos->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="pasos_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Descripción">{{ old('pasos_content', $pasos->content ?? '') }}</textarea>
                    </div>

                    <div class="space-y-6">
                        @foreach(($pasos?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <div class="grid grid-cols-1 gap-6">
                                    <input type="text" name="paso_items[{{ $item->id }}][title]" value="{{ old('paso_items.' . $item->id . '.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                                    <textarea name="paso_items[{{ $item->id }}][content]" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('paso_items.' . $item->id . '.content', $item->content) }}</textarea>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <input type="number" min="1" name="paso_items[{{ $item->id }}][sort_order]" value="{{ old('paso_items.' . $item->id . '.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">

                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="paso_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox" name="paso_items[{{ $item->id }}][status]" value="1" {{ old('paso_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="text-sm text-gray-700">Activo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">CTA final</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="cta_title" value="{{ old('cta_title', $cta->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="cta_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('cta_content', $cta->content ?? '') }}</textarea>
                        <input type="text" name="cta_button_text" value="{{ old('cta_button_text', $cta->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <input type="text" name="cta_button_link" value="{{ old('cta_button_link', $cta->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link botón">
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
