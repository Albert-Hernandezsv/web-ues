<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Perfil de egresado
        </h2>
    </x-slot>

    @php
        $hero = $sections['perfil_hero'] ?? null;
        $intro = $sections['perfil_intro'] ?? null;
        $competencias = $sections['perfil_competencias'] ?? null;
        $expectativas = $sections['perfil_expectativas'] ?? null;
        $aspirante = $sections['perfil_aspirante'] ?? null;
        $egresado = $sections['perfil_egresado'] ?? null;
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

            <form action="{{ route('admin.pages.perfil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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

                @php
                    $blocks = [
                        ['label' => 'Competencias', 'section' => $competencias, 'title' => 'competencias_title', 'content' => 'competencias_content', 'items' => 'competencia_items'],
                        ['label' => 'Expectativas del mercado', 'section' => $expectativas, 'title' => 'expectativas_title', 'content' => 'expectativas_content', 'items' => 'expectativa_items'],
                        ['label' => 'Perfil del aspirante', 'section' => $aspirante, 'title' => 'aspirante_title', 'content' => 'aspirante_content', 'items' => 'aspirante_items'],
                    ];
                @endphp

                @foreach($blocks as $block)
                    <div class="bg-white shadow rounded-2xl p-6">
                        <h3 class="text-2xl font-bold mb-6">{{ $block['label'] }}</h3>

                        <div class="grid grid-cols-1 gap-6 mb-8">
                            <input type="text" name="{{ $block['title'] }}" value="{{ old($block['title'], $block['section']->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                            <textarea name="{{ $block['content'] }}" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Descripción">{{ old($block['content'], $block['section']->content ?? '') }}</textarea>
                        </div>

                        <div class="space-y-6">
                            @foreach(($block['section']?->items ?? collect()) as $item)
                                <div class="border border-slate-200 rounded-2xl p-5">
                                    <div class="grid grid-cols-1 gap-6">
                                        <input type="text" name="{{ $block['items'] }}[{{ $item->id }}][title]" value="{{ old($block['items'].'.'.$item->id.'.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                                        <textarea name="{{ $block['items'] }}[{{ $item->id }}][content]" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old($block['items'].'.'.$item->id.'.content', $item->content) }}</textarea>
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                            <input type="number" min="1" name="{{ $block['items'] }}[{{ $item->id }}][sort_order]" value="{{ old($block['items'].'.'.$item->id.'.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">
                                            <label class="inline-flex items-center gap-2">
                                                <input type="hidden" name="{{ $block['items'] }}[{{ $item->id }}][status]" value="0">
                                                <input type="checkbox" name="{{ $block['items'] }}[{{ $item->id }}][status]" value="1" {{ old($block['items'].'.'.$item->id.'.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                                <span class="text-sm text-gray-700">Activo</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Perfil profesional del egresado</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="egresado_title" value="{{ old('egresado_title', $egresado->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título">
                        <textarea name="egresado_content" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('egresado_content', $egresado->content ?? '') }}</textarea>
                        <input type="text" name="egresado_button_text" value="{{ old('egresado_button_text', $egresado->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto botón">
                        <input type="text" name="egresado_button_link" value="{{ old('egresado_button_link', $egresado->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link botón">
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
