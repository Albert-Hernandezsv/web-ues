<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar caso de éxito
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.alumnis.update', $alumni) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
 @php $canWrite = auth()->user()->can('alumnis.edit') && (!$alumni->status || auth()->user()->can('alumnis.publish')); @endphp
 @if (!$canWrite)<p class="rounded-lg bg-blue-50 p-4">Modo de consulta. Para modificar contenido activo también necesitas permiso de publicación.</p>@endif
 <fieldset @disabled(!$canWrite) class="space-y-6">
                <x-validation-summary />
                @method('PUT')

                <input type="text" name="name" value="{{ old('name', $alumni->name) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Nombre" required>
                <input type="text" name="headline" value="{{ old('headline', $alumni->headline) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Cargo o titular">
                <input type="text" name="company" value="{{ old('company', $alumni->company) }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Empresa o institución">
                <textarea name="summary" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Resumen">{{ old('summary', $alumni->summary) }}</textarea>
                <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Historia completa">{{ old('content', $alumni->content) }}</textarea>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>@can('alumnis.publish')<input type="datetime-local" name="published_at" value="{{ old('published_at', $alumni->published_at ? $alumni->published_at->copy()->timezone(config('publication.timezone'))->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-lg border-gray-300 shadow-sm">@else<input type="hidden" name="published_at" value="{{ $alumni->published_at?->copy()->timezone(config('publication.timezone'))->format('Y-m-d\TH:i') }}">@endcan<p class="mt-1 text-sm text-gray-600">Hora de El Salvador (UTC−6). Si está activo, se publicará al llegar esta fecha y hora. Sin fecha permanece como borrador.</p></div>
                    @can('alumnis.publish')<select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="1" {{ old('status', (string)(int)$alumni->status) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status', (string)(int)$alumni->status) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>@else<input type="hidden" name="status" value="{{ (int) $alumni->status }}"><p class="text-sm text-gray-600">Solo un usuario con permiso de publicación puede cambiar el estado.</p>@endcan
                </div>

                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">

                @if($alumni->image)
                    <img src="{{ asset('storage/' . $alumni->image) }}" class="h-56 w-full max-w-xl object-cover rounded-xl border">
                @endif

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Actualizar
                    </button>

                    <a href="{{ route('admin.alumnis.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Volver
                    </a>
                </div>
            </fieldset></form>
        </div>
    </div>
</x-app-layout>
