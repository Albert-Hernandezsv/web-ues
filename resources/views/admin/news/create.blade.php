<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva noticia
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
 @php $canWrite = auth()->user()->can('news.create'); @endphp
 @if (!$canWrite)<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. Para modificar contenido activo también necesitas permiso de publicación.</p>@endif
 <fieldset @disabled(!$canWrite) class="space-y-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <div class="title-field"><input maxlength="80" data-title-limit type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 shadow-sm" required><p class="title-counter" data-title-counter aria-live="polite">Máximo 80 caracteres</p></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Resumen</label>
                    <textarea name="summary" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('summary') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                    <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('content') }}</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de publicación</label>
                        <div>@can('news.publish')<input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full rounded-lg border-gray-300 shadow-sm">@else<input type="hidden" name="published_at" value="">@endcan<p class="mt-1 text-sm text-gray-600">Hora de El Salvador (UTC−6). Si está activo, se publicará al llegar esta fecha y hora. Sin fecha permanece como borrador.</p></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        @can('news.publish')<select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Activa</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactiva</option>
                        </select>@else<input type="hidden" name="status" value="0"><p class="text-sm text-gray-600">Solo un usuario con permiso de publicación puede cambiar el estado.</p>@endcan
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.news.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Cancelar
                    </a>
                </div>
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
