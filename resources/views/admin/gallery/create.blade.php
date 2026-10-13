<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo elemento de galería
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
 @php $canWrite = auth()->user()->can('gallery.create'); @endphp
 @if (!$canWrite)<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. Para modificar contenido activo también necesitas permiso de publicación.</p>@endif
 <fieldset @disabled(!$canWrite) class="space-y-6">
                <x-validation-summary />

                <div class="title-field"><input maxlength="80" data-title-limit type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Título" required><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                <div class="title-field"><input maxlength="80" data-title-limit type="text" name="subtitle" value="{{ old('subtitle') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Subtítulo"><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Lugar">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <input type="date" name="event_date" value="{{ old('event_date') }}" class="w-full rounded-lg border-gray-300 shadow-sm">

                    <select name="media_type" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="image">Imagen</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <input type="url" name="external_url" value="{{ old('external_url') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="URL externa del video (opcional)">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <input type="number" min="1" name="sort_order" value="{{ old('sort_order', 1) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Orden">
                    @can('gallery.publish')<select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>@else<input type="hidden" name="status" value="0"><p class="text-sm text-gray-600">Solo un usuario con permiso de publicación puede cambiar el estado.</p>@endcan
                </div>

                <p class="text-sm text-gray-600">Solo imágenes JPG, JPEG, PNG o WebP, hasta 20 MB. Para videos, utiliza la URL externa.</p>
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                <input type="file" name="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.gallery.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Cancelar
                    </a>
                </div>
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
