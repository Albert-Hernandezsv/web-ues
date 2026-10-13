<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo caso de éxito
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.alumnis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
 @php $canWrite = auth()->user()->can('alumnis.create'); @endphp
 @if (!$canWrite)<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. Para modificar contenido activo también necesitas permiso de publicación.</p>@endif
 <fieldset @disabled(!$canWrite) class="space-y-6">
                <x-validation-summary />

                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Nombre" required>
                <input type="text" name="headline" value="{{ old('headline') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Cargo o titular">
                <input type="text" name="company" value="{{ old('company') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Empresa o institución">
                <textarea name="summary" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Resumen">{{ old('summary') }}</textarea>
                <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Historia completa">{{ old('content') }}</textarea>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>@can('alumnis.publish')<input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full rounded-lg border-gray-300 shadow-sm">@else<input type="hidden" name="published_at" value="">@endcan<p class="mt-1 text-sm text-gray-600">Hora de El Salvador (UTC−6). Si está activo, se publicará al llegar esta fecha y hora. Sin fecha permanece como borrador.</p></div>
                    @can('alumnis.publish')<select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>@else<input type="hidden" name="status" value="0"><p class="text-sm text-gray-600">Solo un usuario con permiso de publicación puede cambiar el estado.</p>@endcan
                </div>

                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.alumnis.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Cancelar
                    </a>
                </div>
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
