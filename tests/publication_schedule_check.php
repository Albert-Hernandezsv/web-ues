<?php
require __DIR__.'/../vendor/autoload.php';
$app=require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
Illuminate\Support\Facades\Auth::guard()->setUser((new App\Models\User())->forceFill(['id'=>1,'role'=>'admin','is_active'=>true]));
config(['database.default'=>'sqlite','database.connections.sqlite.database'=>':memory:','session.driver'=>'array']);
Illuminate\Support\Facades\DB::purge('sqlite');
foreach(['2025_04_02_153350_create_pages_table.php','2026_04_02_153350_create_page_sections_table.php','2026_04_02_153350_create_home_slider_items_table.php','2026_04_02_153351_create_news_table.php','2026_04_07_152107_create_alumnis_table.php'] as $migration)(require __DIR__.'/../database/migrations/'.$migration)->up();
foreach(['inicio','noticias','alumnis'] as $slug)Illuminate\Support\Facades\DB::table('pages')->insert(['slug'=>$slug,'name'=>$slug,'title'=>$slug,'status'=>true]);
Carbon\Carbon::setTestNow(Carbon\Carbon::parse('2026-10-13 12:00:00','UTC'));
$count=0;
foreach(['News'=>['title','newsItems','noticia'],'Alumni'=>['name','alumnis','alumni']] as $type=>[$field,$listKey,$prefix]){
 $model='App\\Models\\'.$type;$class='App\\Http\\Controllers\\'.$type.'Controller';$controller=new $class();
 foreach(['past'=>['2026-10-13 11:59:59',true,true],'due'=>['2026-10-13 12:00:00',true,true],'future'=>['2026-10-13 12:00:01',true,false],'draft'=>[null,true,false],'inactive'=>['2026-10-13 11:00:00',false,false]] as $slug=>[$date,$active,$visible]){
  $record=$model::create([$field=>$slug,'slug'=>$slug,'published_at'=>$date,'status'=>$active]);
  if($model::published()->whereKey($record->id)->exists()!==$visible)throw new RuntimeException('Wrong scope');
  try{$controller->show($slug);if(!$visible)throw new RuntimeException('Unpublished accessible');}catch(Symfony\Component\HttpKernel\Exception\HttpException $e){if($visible||$e->getStatusCode()!==404)throw $e;}
  $count+=2;
 }
 $ids=$controller->index()->getData()[$listKey]->pluck('slug')->sort()->values()->all();
 if($ids!==['due','past'])throw new RuntimeException('Incorrect public listing');$count++;
 $adminClass='App\\Http\\Controllers\\Admin\\'.$type.'AdminController';$admin=new $adminClass();
 $admin->store(Illuminate\Http\Request::create('/','POST',[$field=>'Programada local','status'=>1,'published_at'=>'2026-10-13T07:00']));
 $record=$model::where('slug','programada-local')->firstOrFail();
 if($record->published_at->format('Y-m-d H:i:s')!=='2026-10-13 13:00:00')throw new RuntimeException('Timezone conversion failed');$count++;
 $id=Illuminate\Support\Facades\DB::table($record->getTable())->insertGetId([$field=>'Legacy','slug'=>'','status'=>true,'published_at'=>'2026-10-13 13:00:00']);
 try{$controller->show($prefix.'-'.$id);throw new RuntimeException('Fallback leaked future record');}catch(Symfony\Component\HttpKernel\Exception\HttpException $e){if($e->getStatusCode()!==404)throw $e;}$count++;
}
$home=(new App\Http\Controllers\HomeController())->index()->getData()['news']->pluck('slug')->sort()->values()->all();
if($home!==['due','past'])throw new RuntimeException('Home leaked future record');$count++;
Carbon\Carbon::setTestNow(Carbon\Carbon::parse('2026-10-13 13:00:00','UTC'));
foreach([App\Models\News::class,App\Models\Alumni::class] as $model){if(!$model::published()->where('slug','programada-local')->exists())throw new RuntimeException('Scheduled record did not publish');$count++;}
Carbon\Carbon::setTestNow();
echo "PASS $count checks: dates, detail URLs, fallback URLs, listings, home, local time and automatic visibility. SQLite memory only.\n";
