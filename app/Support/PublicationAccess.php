<?php
namespace App\Support;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class PublicationAccess
{
    public static function authorize(Request $request, string $module, ?Model $record = null): void
    {
        if (Gate::allows($module.'.publish')) return;
        // Editing active content is itself publication; editors without publish work on drafts.
        abort_if($record?->status, 403, 'Necesitas permiso de publicación para modificar contenido activo.');
        abort_if($request->boolean('status'), 403, 'No tienes permiso para publicar.');
        $submitted = $request->input('published_at');
        $existing = $record?->getAttribute('published_at')?->copy()->timezone(config('publication.timezone'))->format('Y-m-d\TH:i');
        abort_if(($submitted ?? '') !== ($existing ?? ''), 403, 'No tienes permiso para programar publicaciones.');
    }
}
