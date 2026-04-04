<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo archivo
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                        <input type="number" min="1" name="sort_order" value="{{ old('sort_order', 1) }}" class="w-full rounded-lg border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Archivo</label>
                    <input type="file" name="file" class="w-full rounded-lg border-gray-300 shadow-sm" required>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.downloads.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
