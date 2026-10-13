<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar página de noticias
        </h2>
    </x-slot>

    @php
        $hero = $sections['news_hero'] ?? null;
        $intro = $sections['news_intro'] ?? null;
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">




            <form action="{{ route('admin.pages.news.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
 @cannot('pages.news.edit')<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. No tienes permiso para modificar esta página.</p>@endcannot
 <fieldset @disabled(auth()->user()->cannot('pages.news.edit')) class="space-y-6">
                <p class="text-sm text-gray-700">Completa los títulos y contenidos marcados como obligatorios. Los títulos de elementos solo son obligatorios cuando están activos.</p>
                <x-validation-summary />
                @method('PUT')

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Hero principal</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="hero_title" value="{{ old('hero_title', $hero->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subtítulo</label>
                            <div class="title-field"><input maxlength="80" data-title-limit type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        </div>

                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="hero_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('hero_content', $hero->content ?? '') }}</textarea>
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
                            <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="intro_title" value="{{ old('intro_title', $intro->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                            <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="intro_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('intro_content', $intro->content ?? '') }}</textarea>
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

                    @can('news.view')<a href="{{ route('admin.news.index') }}" class="rounded-xl bg-slate-900 px-6 py-3 font-semibold text-white hover:bg-black transition">
                        Administrar publicaciones
                    </a>@endcan
                </div>
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
