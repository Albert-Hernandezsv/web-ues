<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Gestión de usuarios</h2></x-slot>
<div class="max-w-7xl mx-auto p-6 space-y-6">
    <div class="flex justify-between items-center"><p>Administra cuentas, acceso al panel y permisos.</p><a href="{{ route('admin.users.create') }}" class="bg-blue-700 text-white rounded-xl px-5 py-3">Crear usuario</a></div>
    <div class="bg-white rounded-xl shadow overflow-x-auto"><table class="min-w-full text-left">
    <thead><tr class="border-b"><th class="p-4">Nombre</th><th class="p-4">Correo</th><th class="p-4">Rol</th><th class="p-4">Estado</th><th class="p-4">Acciones</th></tr></thead>
    <tbody>@foreach ($users as $account)<tr class="border-b">
    <td class="p-4">{{ $account->name }}</td><td class="p-4">{{ $account->email }}</td><td class="p-4">{{ $account->role === 'admin' ? 'Administrador' : 'Editor' }}</td><td class="p-4">{{ $account->is_active ? 'Activo' : 'Desactivado' }}</td>
    <td class="p-4"><a class="text-blue-700 underline" href="{{ route('admin.users.edit', $account) }}">Editar cuenta y permisos</a></td></tr>@endforeach</tbody>
    </table></div>{{ $users->links() }}
</div>
</x-app-layout>
