<?php
// Run with the project's PHP: php tests/pre_egresados_idor_check.php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['database.default'=>'sqlite', 'database.connections.sqlite.database'=>':memory:', 'session.driver'=>'array']);
Illuminate\Support\Facades\DB::purge('sqlite');
$db = Illuminate\Support\Facades\DB::connection('sqlite');
if ($db->getDatabaseName() !== ':memory:') { throw new RuntimeException('Tests require memory database'); }
foreach (['2025_04_02_153350_create_pages_table.php','2026_04_02_153350_create_page_sections_table.php','2026_04_02_164353_create_page_section_items_table.php'] as $migration) {
    (require __DIR__.'/../database/migrations/'.$migration)->up();
}
$page = $db->table('pages')->insertGetId(['name'=>'Test','slug'=>'pre-egresados','title'=>'Test']);
$other = $db->table('pages')->insertGetId(['name'=>'Other','slug'=>'other','title'=>'Other']);
$keys = ['hero','intro','trabajos_grado','servicio_social_intro','servicio_social_requisitos','servicio_social_objetivos','servicio_social_modalidades','servicio_social_pasos','cta'];
$sections = [];
foreach ($keys as $key) {
    $sections[$key] = $db->table('page_sections')->insertGetId(['page_id'=>$page,'section_key'=>'preegreso_'.$key,'section_name'=>$key,'title'=>'Original']);
}
$foreignSection = $db->table('page_sections')->insertGetId(['page_id'=>$other,'section_key'=>'other','section_name'=>'Other']);
$foreign = $db->table('page_section_items')->insertGetId(['page_section_id'=>$foreignSection,'title'=>'Original']);
$fields = ['trabajo_items'=>'trabajos_grado','ss_req_items'=>'servicio_social_requisitos','ss_obj_items'=>'servicio_social_objetivos','ss_mod_items'=>'servicio_social_modalidades','ss_pas_items'=>'servicio_social_pasos'];
$ids = [];
foreach ($fields as $field=>$key) {
    $ids[$field] = $db->table('page_section_items')->insertGetId(['page_section_id'=>$sections[$key],'title'=>'Original']);
}
$requiredContent = [];
foreach (['hero', 'intro', 'trabajos', 'ss_intro', 'ss_req', 'ss_obj', 'ss_mod', 'ss_pas', 'cta'] as $sectionField) {
    $requiredContent[$sectionField.'_title'] = 'Título de prueba';
    $requiredContent[$sectionField.'_content'] = 'Contenido de prueba';
}
$controller = new App\Http\Controllers\Admin\PreEgresadosPageAdminController();
$count = 0;
foreach ($fields as $field=>$key) {
    $wrongSection = $field === 'trabajo_items' ? $ids['ss_req_items'] : $ids['trabajo_items'];
    foreach ([$foreign, $wrongSection, 999999, '1abc'] as $badId) {
        $before = json_encode([$db->table('page_sections')->get(),$db->table('page_section_items')->get()]);
        $data = ['hero_title'=>'Must not save','trabajo_items'=>[$ids['trabajo_items']=>['title'=>'Must not save']],$field=>[$badId=>['title'=>'Must not save']]];
        try {
            $controller->update(Illuminate\Http\Request::create('/', 'PUT', $data + $requiredContent));
            throw new RuntimeException('Invalid ID was accepted');
        } catch (Illuminate\Validation\ValidationException $e) {
            if (!isset($e->errors()[$field])) { throw $e; }
        }
        $after = json_encode([$db->table('page_sections')->get(),$db->table('page_section_items')->get()]);
        if ($before !== $after) { throw new RuntimeException('Partial changes detected'); }
        $count++;
    }
}
$data = ['hero_title'=>'Updated'];
foreach ($ids as $field=>$id) { $data[$field] = [$id=>['title'=>'Updated','status'=>1]]; }
$controller->update(Illuminate\Http\Request::create('/', 'PUT', $data + $requiredContent));
foreach ($ids as $id) {
    if ($db->table('page_section_items')->where('id',$id)->value('title') !== 'Updated') { throw new RuntimeException('Valid update failed'); }
    $count++;
}
if ($db->table('page_section_items')->where('id',$foreign)->value('title') !== 'Original') { throw new RuntimeException('Foreign item changed'); }
echo "PASS: $count checks; foreign-page, wrong-section, missing and malformed IDs rejected before writes; all five valid groups updated. SQLite memory only.\n";