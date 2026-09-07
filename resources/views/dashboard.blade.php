<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel Administrativo
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <br>
                <h1 class="text-3xl font-bold text-gray-900">Bienvenido al panel</h1>
                <br>
                <p class="text-gray-600 mt-2">
                    Desde aquí podrás administrar el contenido del sitio web de Ingeniería en Desarrollo de Software.
                </p>
                <br>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('profile.edit') }}"
                   class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 1115 0" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestionar usuario</h3>
                    <p class="text-gray-600 text-sm">
                        Actualiza el nombre, correo y contraseña del usuario administrador.
                    </p>
                </a>

                <a href="{{ route('admin.pages.index') }}"
                   class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3H8.25A2.25 2.25 0 006 5.25v13.5A2.25 2.25 0 008.25 21H19.5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18.75H4.5A2.25 2.25 0 012.25 16.5V8.25A2.25 2.25 0 014.5 6H6" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestionar páginas base</h3>
                    <p class="text-gray-600 text-sm">
                        Administra las páginas principales del sitio. Luego definimos qué llevará exactamente.
                    </p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
