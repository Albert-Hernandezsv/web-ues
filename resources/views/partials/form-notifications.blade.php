@php
$notices = [];
foreach (['success'=>'success','success_password'=>'success','error'=>'error','warning'=>'warning','info'=>'info'] as $key=>$kind) {
    if (session()->has($key)) $notices[] = ['kind'=>$kind,'text'=>(string) session($key)];
}
$status = session('status');
if ($status) {
    $messages = ['profile-updated'=>'Datos actualizados correctamente.','password-updated'=>'Contraseña actualizada correctamente.','verification-link-sent'=>'Se ha enviado el enlace de verificación a tu correo.'];
    $notices[] = ['kind'=>'success','text'=>$messages[$status] ?? __($status)];
}
$validation = [];
foreach ($errors->getBags() as $bag) $validation = array_merge($validation, $bag->all());
if ($validation) array_unshift($notices, ['kind'=>'error','text'=>implode("
", array_unique($validation))]);
@endphp
@if ($notices)
<div class="ues-notices" data-form-notifications data-notices="{{ json_encode($notices, JSON_UNESCAPED_UNICODE) }}" role="status">
@foreach ($notices as $notice)
<div class="ues-notice ues-notice--{{ $notice['kind'] }}">{{ $notice['text'] }}</div>
@endforeach
</div>
@endif
