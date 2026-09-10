<?php
// Standalone regression check: php tests/security_headers_check.php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();
config(['session.driver'=>'array','cache.default'=>'array','app.debug'=>false]);
$app['router']->get('/__headers_test/ok', fn () => response('ok'));
$app['router']->get('/__headers_test/redirect', fn () => redirect('/'));
$app['router']->get('/__headers_test/error', fn () => abort(404));
$app['router']->get('/__headers_test/csp', fn () => response('ok')->header('Content-Security-Policy', "default-src 'self'"));
$expected = ['X-Frame-Options'=>'SAMEORIGIN','X-Content-Type-Options'=>'nosniff','Referrer-Policy'=>'strict-origin-when-cross-origin'];
foreach (['ok'=>200,'redirect'=>302,'error'=>404,'csp'=>200] as $path=>$status) {
    $response = $kernel->handle(Illuminate\Http\Request::create('/__headers_test/'.$path));
    if ($response->getStatusCode() !== $status) { throw new RuntimeException('Unexpected response status'); }
    foreach ($expected as $header=>$value) {
        if ($response->headers->get($header) !== $value) { throw new RuntimeException('Missing header: '.$header); }
    }
    $policies = $response->headers->all('Content-Security-Policy');
    if (!in_array("frame-ancestors 'self'", $policies, true)) { throw new RuntimeException('Missing framing policy'); }
    if ($path === 'csp' && !in_array("default-src 'self'", $policies, true)) { throw new RuntimeException('Existing policy overwritten'); }
    echo "PASS $path ($status)\n";
}