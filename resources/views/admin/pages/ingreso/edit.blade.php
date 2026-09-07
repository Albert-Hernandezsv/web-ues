<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar página de ingreso
        </h2>
    </x-slot>

    @php
        $hero = $sections['ingreso_hero'] ?? null;
        $periodo = $sections['ingreso_periodo'] ?? null;
        $steps = $sections['ingreso_steps'] ?? null;
        $recordatorio = $sections['ingreso_recordatorio'] ?? null;
        $contacto = $sections['ingreso_contacto'] ?? null;
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

            <form action="{{ route('admin.pages.ingreso.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

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
                    <h3 class="text-2xl font-bold mb-6">Período oficial</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="periodo_title" value="{{ old('periodo_title', $periodo->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="periodo_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('periodo_content', $periodo->content ?? '') }}</textarea>
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha o período destacado</label>
                            <input type="text" name="periodo_extra_1" value="{{ old('periodo_extra_1', $periodo->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Sección de pasos</h3>

                    <div class="grid grid-cols-1 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="steps_title" value="{{ old('steps_title', $steps->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea name="steps_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('steps_content', $steps->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-8">
                        @foreach(($steps?->items ?? collect()) as $item)
                            <div class="border border-slate-200 rounded-2xl p-5">
                                <h4 class="font-semibold text-lg mb-4">Paso #{{ $loop->iteration }}</h4>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                        <input type="text"
                                               name="steps_items[{{ $item->id }}][title]"
                                               value="{{ old('steps_items.' . $item->id . '.title', $item->title) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                                        <textarea
                                            name="steps_items[{{ $item->id }}][content]"
                                            rows="4"
                                            class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('steps_items.' . $item->id . '.content', $item->content) }}</textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                                        <input type="text"
                                               name="steps_items[{{ $item->id }}][link]"
                                               value="{{ old('steps_items.' . $item->id . '.link', $item->link) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                                        <input type="number"
                                               min="1"
                                               name="steps_items[{{ $item->id }}][sort_order]"
                                               value="{{ old('steps_items.' . $item->id . '.sort_order', $item->sort_order) }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm">
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="inline-flex items-center gap-2">
                                            <input type="hidden" name="steps_items[{{ $item->id }}][status]" value="0">
                                            <input type="checkbox"
                                                   name="steps_items[{{ $item->id }}][status]"
                                                   value="1"
                                                   {{ old('steps_items.' . $item->id . '.status', $item->status) ? 'checked' : '' }}
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
                    <h3 class="text-2xl font-bold mb-6">Recordatorio</h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="recordatorio_title" value="{{ old('recordatorio_title', $recordatorio->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="recordatorio_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('recordatorio_content', $recordatorio->content ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Contacto</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="contacto_title" value="{{ old('contacto_title', $contacto->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <textarea name="contacto_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('contacto_content', $contacto->content ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Texto del botón</label>
                            <input type="text" name="contacto_button_text" value="{{ old('contacto_button_text', $contacto->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link del botón</label>
                            <input type="text" name="contacto_button_link" value="{{ old('contacto_button_link', $contacto->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Correo de contacto</label>
                            <input type="text" name="contacto_extra_1" value="{{ old('contacto_extra_1', $contacto->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
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
