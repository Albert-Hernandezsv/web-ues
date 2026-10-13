<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">{{ $account->exists ? 'Editar cuenta' : 'Crear usuario' }}</h2></x-slot>
<div class="max-w-5xl mx-auto p-6">
<form method="POST" action="{{ $account->exists ? route('admin.users.update', $account) : route('admin.users.store') }}" class="bg-white rounded-xl shadow p-6 space-y-6" x-data="{ role: @js(old('role', $account->role ?? 'editor')) }">
@csrf
@if ($account->exists) @method('PUT') @endif
<x-validation-summary />
<div><label for="account-name" class="block font-semibold">Nombre *</label><input id="account-name" name="name" value="{{ old('name', $account->name) }}" required maxlength="255" class="w-full rounded-lg border-gray-300"></div>
<div><label for="account-email" class="block font-semibold">Correo *</label><input id="account-email" type="email" name="email" value="{{ old('email', $account->email) }}" required maxlength="255" class="w-full rounded-lg border-gray-300" autocomplete="off"></div>
<div><label for="account-password" class="block font-semibold">{{ $account->exists ? 'Nueva contraseña (opcional)' : 'Contraseña *' }}</label><input id="account-password" type="password" name="password" minlength="12" maxlength="255" @required(!$account->exists) autocomplete="new-password" class="w-full rounded-lg border-gray-300"><p class="text-sm text-gray-600">Mínimo 12 caracteres. {{ $account->exists ? 'Déjala vacía para conservar la actual.' : '' }}</p></div>
<div><label for="account-password-confirmation" class="block font-semibold">Confirmar contraseña</label><input id="account-password-confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="w-full rounded-lg border-gray-300"></div>
<div><label for="account-role" class="block font-semibold">Rol *</label><select id="account-role" name="role" x-model="role" required class="rounded-lg border-gray-300"><option value="editor" @selected(old('role', $account->role ?? 'editor') === 'editor')>Editor</option><option value="admin" @selected(old('role', $account->role) === 'admin')>Administrador</option></select></div>
<div><label for="account-active" class="block font-semibold">Estado *</label><select id="account-active" name="is_active" required class="rounded-lg border-gray-300"><option value="1" @selected((int) old('is_active', $account->is_active ?? 1) === 1)>Activo</option><option value="0" @selected((int) old('is_active', $account->is_active ?? 1) === 0)>Desactivado</option></select></div>
<p class="text-sm text-gray-700">El Administrador tiene todos los permisos. El Editor solo tiene los seleccionados. Al asignar una acción se incluye la consulta del módulo. Desactivar una cuenta bloquea su acceso, incluso con una sesión abierta.</p>
<fieldset :disabled="role === 'admin'" :class="{ 'opacity-50': role === 'admin' }" class="space-y-4">
<legend class="text-xl font-semibold">Permisos del Editor</legend>
@php $selectedPermissions = session()->hasOldInput() ? old('permissions', []) : ($account->permissions ?? []); @endphp
@foreach ($modules as $module => $definition)
<div class="rounded-xl border border-gray-200 p-4"><h3 class="font-semibold mb-3">{{ $definition['label'] }}</h3><div class="flex flex-wrap gap-4">
@foreach ($definition['actions'] as $action => $label)
<label class="inline-flex items-center gap-2"><input type="checkbox" name="permissions[]" value="{{ $module.'.'.$action }}" @checked(in_array($module.'.'.$action, $selectedPermissions)) class="rounded border-gray-300">{{ $label }}</label>
@endforeach
</div></div>
@endforeach
</fieldset>
<p class="text-sm text-gray-600">Editar una página base cambia el sitio público directamente. En Noticias, Alumnis, Galería y Descargas, quien no puede publicar trabaja únicamente sobre borradores inactivos.</p>
<div class="flex gap-4"><button type="submit" class="bg-blue-700 text-white rounded-xl px-5 py-3">Guardar cuenta</button><a href="{{ route('admin.users.index') }}" class="rounded-xl px-5 py-3 bg-gray-100">Cancelar</a></div>
</form></div>
</x-app-layout>
