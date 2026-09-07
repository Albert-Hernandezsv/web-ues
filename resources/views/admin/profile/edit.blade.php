<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestionar usuario
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('success_password'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success_password') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Actualizar datos del usuario</h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg transition"
                        >
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Cambiar contraseña</h3>

                <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña actual</label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        @error('current_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contraseña</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar nueva contraseña</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="bg-gray-800 hover:bg-black text-white font-semibold px-5 py-2.5 rounded-lg transition"
                        >
                            Actualizar contraseña
                        </button>
                    </div>
                </form>
            </div>

            <div>
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">
                    ← Volver al dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
