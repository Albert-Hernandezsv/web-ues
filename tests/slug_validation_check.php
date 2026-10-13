<?php
require __DIR__.'/../vendor/autoload.php';
$app=require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
Illuminate\Support\Facades\Auth::guard()->setUser((new App\Models\User())->forceFill(['id'=>1,'role'=>'admin','is_active'=>true]));
config(['database.default'=>'sqlite','database.connections.sqlite.database'=>':memory:','session.driver'=>'array']);
Illuminate\Support\Facades\DB::purge('sqlite');
foreach(['2026_04_02_153351_create_news_table.php','2026_04_07_152107_create_alumnis_table.php'] as $migration)(require __DIR__.'/../database/migrations/'.$migration)->up();
$count=0;
foreach (['News'=>['title','noticia','news','news.show'],'Alumni'=>['name','alumni','alumnis','alumnis.show']] as $class=>[$field,$prefix,$table,$route]) {
 $model='App\\Models\\'.$class;$adminClass='App\\Http\\Controllers\\Admin\\'.$class.'AdminController';$publicClass='App\\Http\\Controllers\\'.$class.'Controller';
 $admin=new $adminClass();$public=new $publicClass();
 $record=$model::create([$field=>'Original','slug'=>'original','status'=>true]);
 foreach(['store','update'] as $action)foreach(['¡¿!?','***','😀'] as $invalid){
  try{$admin->$action(Illuminate\Http\Request::create('/','POST',[$field=>$invalid,'status'=>1]),$record);throw new RuntimeException('Accepted empty slug');}
  catch(Illuminate\Validation\ValidationException $e){if(!isset($e->errors()[$field]))throw $e;}
  if($model::count()!==1||$record->fresh()->slug!=='original')throw new RuntimeException('Rejected data was saved');$count++;
 }
 $admin->store(Illuminate\Http\Request::create('/','POST',[$field=>'José Pérez 2026','status'=>1]));
 if(!$model::where('slug','jose-perez-2026')->exists())throw new RuntimeException('Valid accents rejected');$count++;
 $fallback=$model::create([$field=>'***','slug'=>'','status'=>true,'published_at'=>'2020-01-01 00:00:00']);
 if(!str_starts_with($fallback->getRawOriginal('slug'),$prefix.'-'))throw new RuntimeException('Missing model fallback');$count++;
 $legacyId=Illuminate\Support\Facades\DB::table($table)->insertGetId([$field=>'Old','slug'=>'','status'=>true,'published_at'=>'2020-01-01 00:00:00']);
 $legacy=$model::findOrFail($legacyId);
 if($legacy->slug!==$prefix.'-'.$legacyId)throw new RuntimeException('Missing legacy link');
 route($route,$legacy->slug);
 $view=$public->show($legacy->slug);
 $viewRecord=array_values($view->getData())[0];
 if($viewRecord->id!==$legacyId)throw new RuntimeException('Incorrect fallback record');$count++;
 Illuminate\Support\Facades\DB::table($table)->where('id',$legacyId)->update(['status'=>false]);
 try{$public->show($legacy->slug);throw new RuntimeException('Inactive record visible');}catch(Symfony\Component\HttpKernel\Exception\HttpException $e){if($e->getStatusCode()!==404)throw $e;}$count++;
}
echo "PASS: $count checks; create/update rejection, accents, model fallback, legacy links and inactive records. SQLite memory only.\n";
