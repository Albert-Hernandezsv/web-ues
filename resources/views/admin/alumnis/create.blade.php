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

                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Nombre" required>
                <input type="text" name="headline" value="{{ old('headline') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Cargo o titular">
                <input type="text" name="company" value="{{ old('company') }}" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Empresa o institución">
                <textarea name="summary" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Resumen">{{ old('summary') }}</textarea>
                <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm" placeholder="Historia completa">{{ old('content') }}</textarea>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full rounded-lg border-gray-300 shadow-sm">
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
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
            </form>
        </div>
    </div>
</x-app-layout>
