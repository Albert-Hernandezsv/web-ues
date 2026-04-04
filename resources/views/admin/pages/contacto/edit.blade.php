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

            <form action="{{ route('admin.pages.contacto.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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
                    <h3 class="text-2xl font-bold mb-6">Información de contacto</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="info_title" value="{{ old('info_title', $info->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="info_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('info_content', $info->content ?? '') }}</textarea>
                        <input type="text" name="info_phone" value="{{ old('info_phone', $info->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Teléfono">
                        <input type="text" name="info_email" value="{{ old('info_email', $info->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Correo">
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Redes sociales</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="social_title" value="{{ old('social_title', $social->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="social_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('social_content', $social->content ?? '') }}</textarea>
                        <input type="text" name="social_button_text" value="{{ old('social_button_text', $social->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <input type="text" name="social_button_link" value="{{ old('social_button_link', $social->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link Facebook">
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Ubicación</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="maps_title" value="{{ old('maps_title', $maps->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="maps_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('maps_content', $maps->content ?? '') }}</textarea>
                        <input type="text" name="maps_button_text" value="{{ old('maps_button_text', $maps->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <textarea name="maps_button_link" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link Google Maps">{{ old('maps_button_link', $maps->button_link ?? '') }}</textarea>
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Mensaje final</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="cta_title" value="{{ old('cta_title', $cta->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="cta_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('cta_content', $cta->content ?? '') }}</textarea>
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
