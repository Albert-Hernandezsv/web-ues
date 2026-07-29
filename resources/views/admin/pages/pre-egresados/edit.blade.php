<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Egresados parte 2
        </h2>
    </x-slot>

    @php
        $hero = $sections['preegreso_hero'] ?? null;
        $intro = $sections['preegreso_intro'] ?? null;
        $trabajos = $sections['preegreso_trabajos_grado'] ?? null;
        $ssIntro = $sections['preegreso_servicio_social_intro'] ?? null;
        $ssReq = $sections['preegreso_servicio_social_requisitos'] ?? null;
        $ssObj = $sections['preegreso_servicio_social_objetivos'] ?? null;
        $ssMod = $sections['preegreso_servicio_social_modalidades'] ?? null;
        $ssPas = $sections['preegreso_servicio_social_pasos'] ?? null;
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
                    <h3 class="text-2xl font-bold mb-6">Hero</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="hero_title" value="{{ old('hero_title', $hero->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $hero->subtitle ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtitulo">
                        <textarea name="hero_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('hero_content', $hero->content ?? '') }}</textarea>
                        <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                        @if(!empty($hero?->image_1))
                            <img src="{{ asset('storage/' . $hero->image_1) }}" class="h-56 w-full max-w-xl object-cover rounded-xl border">
                        @endif
                    </div>
                </div>

                <div class="bg-white shadow rounded-2xl p-6">
                    <h3 class="text-2xl font-bold mb-6">Introduccion</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="intro_title" value="{{ old('intro_title', $intro->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                        <textarea name="intro_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('intro_content', $intro->content ?? '') }}</textarea>
                    </div>
                </div>

                @php
                    $simpleSections = [
                        ['title' => 'Trabajos de grado', 'section' => $trabajos, 'title_name' => 'trabajos_title', 'content_name' => 'trabajos_content'],
                        ['title' => 'Introduccion a servicio social', 'section' => $ssIntro, 'title_name' => 'ss_intro_title', 'content_name' => 'ss_intro_content'],
                        ['title' => 'Requisitos de servicio social', 'section' => $ssReq, 'title_name' => 'ss_req_title', 'content_name' => 'ss_req_content'],
                        ['title' => 'Objetivos del servicio social', 'section' => $ssObj, 'title_name' => 'ss_obj_title', 'content_name' => 'ss_obj_content'],
                        ['title' => 'Modalidades del servicio social', 'section' => $ssMod, 'title_name' => 'ss_mod_title', 'content_name' => 'ss_mod_content'],
                        ['title' => 'Pasos del tramite', 'section' => $ssPas, 'title_name' => 'ss_pas_title', 'content_name' => 'ss_pas_content'],
                    ];
                @endphp

                @foreach($simpleSections as $block)
                    <div class="bg-white shadow rounded-2xl p-6">
                        <h3 class="text-2xl font-bold mb-6">{{ $block['title'] }}</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <input type="text" name="{{ $block['title_name'] }}" value="{{ old($block['title_name'], $block['section']->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                            <textarea name="{{ $block['content_name'] }}" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old($block['content_name'], $block['section']->content ?? '') }}</textarea>

                            @if($block['title_name'] === 'ss_intro_title')
                                <input type="text" name="ss_intro_extra_1" value="{{ old('ss_intro_extra_1', $ssIntro->extra_1 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Dato 1">
                                <input type="text" name="ss_intro_extra_2" value="{{ old('ss_intro_extra_2', $ssIntro->extra_2 ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Dato 2">
                            @endif
                        </div>
                    </div>
                @endforeach

                @php
                    $itemBlocks = [
                        ['label' => 'Items de trabajos de grado', 'items_name' => 'trabajo_items', 'image_name' => 'trabajo_images', 'section' => $trabajos, 'has_subtitle' => false, 'has_image' => true, 'has_extra_1' => false],
                        ['label' => 'Items de requisitos', 'items_name' => 'ss_req_items', 'image_name' => null, 'section' => $ssReq, 'has_subtitle' => true, 'has_image' => false, 'has_extra_1' => false],
                        ['label' => 'Items de objetivos', 'items_name' => 'ss_obj_items', 'image_name' => null, 'section' => $ssObj, 'has_subtitle' => false, 'has_image' => false, 'has_extra_1' => false],
                        ['label' => 'Items de modalidades', 'items_name' => 'ss_mod_items', 'image_name' => null, 'section' => $ssMod, 'has_subtitle' => false, 'has_image' => false, 'has_extra_1' => false],
                        ['label' => 'Items de pasos', 'items_name' => 'ss_pas_items', 'image_name' => null, 'section' => $ssPas, 'has_subtitle' => false, 'has_image' => false, 'has_extra_1' => false],
                    ];
                @endphp

                @foreach($itemBlocks as $block)
                    <div class="bg-white shadow rounded-2xl p-6">
                        <h3 class="text-2xl font-bold mb-6">{{ $block['label'] }}</h3>

                        <div class="space-y-6">
                            @foreach(($block['section']?->items ?? collect()) as $item)
                                <div class="border border-slate-200 rounded-2xl p-5">
                                    <div class="grid grid-cols-1 gap-6">
                                        <input type="text" name="{{ $block['items_name'] }}[{{ $item->id }}][title]" value="{{ old($block['items_name'].'.'.$item->id.'.title', $item->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">

                                        @if($block['has_subtitle'])
                                            <input type="text" name="{{ $block['items_name'] }}[{{ $item->id }}][subtitle]" value="{{ old($block['items_name'].'.'.$item->id.'.subtitle', $item->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtitulo">
                                        @endif

                                        <textarea name="{{ $block['items_name'] }}[{{ $item->id }}][content]" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old($block['items_name'].'.'.$item->id.'.content', $item->content) }}</textarea>

                                        @if($block['has_extra_1'])
                                            <input type="text" name="{{ $block['items_name'] }}[{{ $item->id }}][extra_1]" value="{{ old($block['items_name'].'.'.$item->id.'.extra_1', $item->extra_1) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Nota adicional">
                                        @endif

                                        @if($block['has_image'])
                                            <input type="file" name="{{ $block['image_name'] }}[{{ $item->id }}]" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" class="h-40 w-full max-w-md object-cover rounded-xl border">
                                            @endif
                                        @endif

                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                            <input type="number" min="1" name="{{ $block['items_name'] }}[{{ $item->id }}][sort_order]" value="{{ old($block['items_name'].'.'.$item->id.'.sort_order', $item->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">

                                            <label class="inline-flex items-center gap-2">
                                                <input type="hidden" name="{{ $block['items_name'] }}[{{ $item->id }}][status]" value="0">
                                                <input type="checkbox" name="{{ $block['items_name'] }}[{{ $item->id }}][status]" value="1" {{ old($block['items_name'].'.'.$item->id.'.status', $item->status) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
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
                    <h3 class="text-2xl font-bold mb-6">CTA final</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="cta_title" value="{{ old('cta_title', $cta->title ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Titulo">
                        <textarea name="cta_content" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Contenido">{{ old('cta_content', $cta->content ?? '') }}</textarea>
                        <input type="text" name="cta_button_text" value="{{ old('cta_button_text', $cta->button_text ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Texto boton">
                        <input type="text" name="cta_button_link" value="{{ old('cta_button_link', $cta->button_link ?? '') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Link boton">
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
