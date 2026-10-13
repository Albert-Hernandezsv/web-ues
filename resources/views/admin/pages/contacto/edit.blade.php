<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Contacto
        </h2>
    </x-slot>

    @php
        $hero = $sections['contacto_hero'] ?? null;
        $info = $sections['contacto_info'] ?? null;
        $social = $sections['contacto_social'] ?? null;
        $maps = $sections['contacto_maps'] ?? null;
        $cta = $sections['contacto_cta'] ?? null;
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">




            <form action="{{ route('admin.pages.contacto.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
 @cannot('pages.contacto.edit')<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. No tienes permiso para modificar esta página.</p>@endcannot
 <fieldset @disabled(auth()->user()->cannot('pages.contacto.edit')) class="space-y-6">
                <p class="text-sm text-gray-700">Completa los títulos y contenidos marcados como obligatorios. Los títulos de elementos solo son obligatorios cuando están activos.</p>
                <x-validation-summary />
                @method('PUT')

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Hero principal</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="hero_title" value="{{ old('hero_title', $hero->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <div class="title-field"><input maxlength="80" data-title-limit type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="hero_content" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('hero_content', $hero->content ?? '') }}</textarea>
                        <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                        @if(!empty($hero?->image_1))
                            <img src="{{ asset('storage/' . $hero->image_1) }}" class="h-56 w-full max-w-xl object-cover rounded-xl border">
                        @endif
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Información de contacto</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="info_title" value="{{ old('info_title', $info->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="info_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('info_content', $info->content ?? '') }}</textarea>
                        <input type="text" name="info_phone" value="{{ old('info_phone', $info->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Teléfono">
                        <input type="text" name="info_email" value="{{ old('info_email', $info->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Correo">
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Redes sociales</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="social_title" value="{{ old('social_title', $social->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="social_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('social_content', $social->content ?? '') }}</textarea>
                        <input type="text" name="social_button_text" value="{{ old('social_button_text', $social->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <input type="text" name="social_button_link" value="{{ old('social_button_link', $social->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link Facebook">
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Ubicación</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="maps_title" value="{{ old('maps_title', $maps->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="maps_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('maps_content', $maps->content ?? '') }}</textarea>
                        <input type="text" name="maps_button_text" value="{{ old('maps_button_text', $maps->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <textarea name="maps_button_link" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link Google Maps">{{ old('maps_button_link', $maps->button_link ?? '') }}</textarea>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Mensaje final</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="title-field"><span class="text-xs font-semibold text-red-700">Obligatorio</span><input required maxlength="80" data-title-limit type="text" name="cta_title" value="{{ old('cta_title', $cta->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                        <span class="text-xs font-semibold text-red-700">Obligatorio</span><textarea required name="cta_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('cta_content', $cta->content ?? '') }}</textarea>
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
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
