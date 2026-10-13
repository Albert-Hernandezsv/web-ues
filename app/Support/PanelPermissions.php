<?php
namespace App\Support;

class PanelPermissions
{
    public static function modules(): array
    {
        $modules = [];
        foreach (['home'=>'Inicio','ingreso'=>'Ingreso','news'=>'Página de Noticias','plan'=>'Plan de estudios','perfil'=>'Egresados parte 1','contacto'=>'Contacto','descargas'=>'Página de Descargas','preegreso'=>'Egresados parte 2','alumnis'=>'Página de Alumnis','gallery'=>'Página de Galería'] as $key=>$label) {
            $modules['pages.'.$key] = ['label'=>$label, 'actions'=>['view'=>'Consultar','edit'=>'Editar contenido publicado']];
        }
        foreach (['news'=>'Noticias','alumnis'=>'Alumnis','gallery'=>'Galería','downloads'=>'Descargas'] as $key=>$label) {
            $modules[$key] = ['label'=>$label, 'actions'=>['view'=>'Consultar','create'=>'Crear borradores','edit'=>'Editar','delete'=>'Eliminar','publish'=>'Publicar / programar / desactivar']];
        }
        return $modules;
    }

    public static function all(): array
    {
        $permissions = [];
        foreach (self::modules() as $module=>$data) foreach ($data['actions'] as $action=>$label) $permissions[] = $module.'.'.$action;
        return $permissions;
    }

    public static function normalize(array $permissions): array
    {
        foreach ($permissions as $permission) $permissions[] = substr($permission, 0, strrpos($permission, '.')).'.view';
        return array_values(array_unique($permissions));
    }

    public static function forRoute(?string $route): ?string
    {
        if ($route === 'dashboard' || str_starts_with($route ?? '', 'profile.')) return null;
        if ($route === 'admin.pages.index') return 'pages.access';
        if (str_starts_with($route ?? '', 'admin.users.')) return 'users.manage';
        if (preg_match('/^admin\.pages\.([a-z]+)\.(edit|update)$/', $route ?? '', $m)) return 'pages.'.$m[1].'.'.($m[2] === 'edit' ? 'view' : 'edit');
        if (preg_match('/^admin\.(news|alumnis|gallery|downloads)\.(index|create|store|edit|update|destroy)$/', $route ?? '', $m)) {
            return $m[1].'.'.(['index'=>'view','create'=>'create','store'=>'create','edit'=>'view','update'=>'edit','destroy'=>'delete'][$m[2]]);
        }
        return 'deny';
    }
}
