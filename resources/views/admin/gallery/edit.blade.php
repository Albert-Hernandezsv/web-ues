<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar elemento de galería
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
                @method('PUT')

                <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título" required>
                <input type="text" name="subtitle" value="{{ old('subtitle', $gallery->subtitle) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo">
                <input type="text" name="location" value="{{ old('location', $gallery->location) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Lugar">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <input type="date" name="event_date" value="{{ old('event_date', $gallery->event_date ? $gallery->event_date->format('Y-m-d') : '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">

                    <select name="media_type" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="image" {{ old('media_type', $gallery->media_type) === 'image' ? 'selected' : '' }}>Imagen</option>
                        <option value="video" {{ old('media_type', $gallery->media_type) === 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <input type="url" name="external_url" value="{{ old('external_url', $gallery->external_url) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="URL externa del video (opcional)">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <input type="number" min="1" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="1" {{ old('status', (string)(int)$gallery->status) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status', (string)(int)$gallery->status) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <input type="file" name="file" class="w-full rounded-lg border-gray-300 shadow-sm">

                @if($gallery->file_path && $gallery->media_type === 'image')
                    <img src="{{ asset('storage/' . $gallery->file_path) }}" class="h-56 w-full max-w-xl object-cover rounded-xl border">
                @endif

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Actualizar
                    </button>

                    <a href="{{ route('admin.gallery.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
