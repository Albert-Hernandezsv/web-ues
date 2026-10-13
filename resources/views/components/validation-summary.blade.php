@if ($errors->any())
    <section role="alert" aria-label="Errores de validación" class="rounded-xl border-2 border-red-700 bg-red-50 p-4 text-red-900 shadow-sm">
        <h3 class="font-bold text-lg">No se guardaron los cambios</h3>
        <p class="mt-1 text-sm">Corrige los siguientes errores y vuelve a guardar. Si seleccionaste un archivo, debes seleccionarlo nuevamente.</p>
        <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </section>
@endif