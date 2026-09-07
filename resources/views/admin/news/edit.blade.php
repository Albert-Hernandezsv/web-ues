<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar noticia
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

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-2xl p-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Resumen</label>
                    <textarea name="summary" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('summary', $news->summary) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                    <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de publicación</label>
                        <input type="datetime-local"
                               name="published_at"
                               value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="1" {{ old('status', (string)(int)$news->status) == '1' ? 'selected' : '' }}>Activa</option>
                            <option value="0" {{ old('status', (string)(int)$news->status) == '0' ? 'selected' : '' }}>Inactiva</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border-gray-300 shadow-sm">

                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" class="mt-4 h-56 w-full max-w-xl object-cover rounded-xl border">
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                        Actualizar
                    </button>

                    <a href="{{ route('admin.news.index') }}" class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-300 transition">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
