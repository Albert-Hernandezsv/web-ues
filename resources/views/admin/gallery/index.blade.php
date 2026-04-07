<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Administrar galería
            </h2>

            <a href="{{ route('admin.gallery.create') }}"
               class="rounded-xl bg-blue-600 px-5 py-2.5 font-semibold text-white hover:bg-blue-700 transition">
                Nuevo elemento
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Título</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Tipo</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Lugar</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Fecha</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Estado</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($galleries as $item)
                                <tr>
                                    <td class="px-4 py-4">
                                        <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                                        <div class="text-sm text-slate-500">{{ $item->subtitle }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-slate-700">
                                        {{ $item->media_type === 'image' ? 'Imagen' : 'Video' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-slate-700">
                                        {{ $item->location ?: 'Sin lugar' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-slate-700">
                                        {{ $item->event_date?->format('d/m/Y') ?? 'Sin fecha' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        @if($item->status)
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-green-700 font-semibold">Activo</span>
                                        @else
                                            <span class="rounded-full bg-red-100 px-3 py-1 text-red-700 font-semibold">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.gallery.edit', $item) }}" class="text-blue-600 font-semibold hover:underline">
                                                Editar
                                            </a>

                                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('¿Eliminar este elemento?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 font-semibold hover:underline">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-slate-500">
                                        No hay elementos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
