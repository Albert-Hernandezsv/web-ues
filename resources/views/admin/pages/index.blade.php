<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestionar páginas base
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('admin.pages.home.edit') }}"
                   class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Inicio</h3>
                    <p class="text-gray-600 text-sm">
                        Edita el slider, la sección informativa, plan de estudios y encabezado de noticias.
                    </p>
                </a>

                <a href="{{ route('admin.pages.ingreso.edit') }}"
                   class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Ingreso</h3>
                    <p class="text-gray-600 text-sm">
                        Edita el hero, período, pasos del proceso, recordatorio y contacto.
                    </p>
                </a>

                <a href="{{ route('admin.pages.news.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Noticias</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el encabezado de la página de noticias y administra las publicaciones.
                        </p>
                </a>
                <a href="{{ route('admin.pages.plan.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Plan de estudios</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el hero, introducción, resumen, áreas de formación, malla por ciclos y CTA final.
                        </p>
                </a>

                <a href="{{ route('admin.pages.perfil.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Egresados parte 1</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el hero, introducción, competencias, expectativas del mercado, perfil del aspirante y perfil profesional del egresado.
                        </p>
                </a>

                <a href="{{ route('admin.pages.contacto.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Contacto</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el hero, información de contacto, redes sociales, ubicación y mensaje final.
                        </p>
                </a>

                <a href="{{ route('admin.pages.descargas.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Descargas</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el encabezado de la página de descargas y administra los archivos disponibles.
                        </p>
                </a>

                <a href="{{ route('admin.pages.preegreso.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Egresados parte 2</h3>
                        <p class="text-gray-600 text-sm">
                            Edita trabajos de grado, servicio social, pasos del tramite y CTA final.
                        </p>
                </a>

                <a href="{{ route('admin.pages.alumnis.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Alumnis</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el encabezado de la página y administra casos de éxito de ex-estudiantes.
                        </p>
                </a>

                <a href="{{ route('admin.pages.gallery.edit') }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Galería</h3>
                        <p class="text-gray-600 text-sm">
                            Edita el encabezado de la página y administra imágenes y videos publicados.
                        </p>
                </a>
            </div>
        </div>
    </div>


</x-app-layout>
