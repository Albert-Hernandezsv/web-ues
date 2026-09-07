<?php

use App\Http\Controllers\Admin\HomePageAdminController;
use App\Http\Controllers\Admin\IngresoPageAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\NewsPageAdminController;
use App\Http\Controllers\Admin\PlanEstudioPageAdminController;
use App\Http\Controllers\Admin\PerfilEgresadoPageAdminController;
use App\Http\Controllers\Admin\ContactoPageAdminController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Admin\DescargasPageAdminController;
use App\Http\Controllers\Admin\DownloadAdminController;
use App\Http\Controllers\Admin\PreEgresadosPageAdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Admin\AlumnisPageAdminController;
use App\Http\Controllers\Admin\AlumniAdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryPageAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestión de Perfil
    Route::get('/gestionar-usuario', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/gestionar-usuario', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/gestionar-usuario', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/gestionar-usuario/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Gestión de Páginas
    Route::get('/gestionar-paginas-base', function () {
        return view('admin.pages.index');
    })->name('admin.pages.index');

    // Inicio
    Route::get('/gestionar-paginas-base/inicio', [HomePageAdminController::class, 'edit'])->name('admin.pages.home.edit');
    Route::put('/gestionar-paginas-base/inicio', [HomePageAdminController::class, 'update'])->name('admin.pages.home.update');

    // Ingreso
    Route::get('/gestionar-paginas-base/ingreso', [IngresoPageAdminController::class, 'edit'])->name('admin.pages.ingreso.edit');
    Route::put('/gestionar-paginas-base/ingreso', [IngresoPageAdminController::class, 'update'])->name('admin.pages.ingreso.update');

    // News
    Route::get('/gestionar-paginas-base/noticias', [NewsPageAdminController::class, 'edit'])->name('admin.pages.news.edit');
    Route::put('/gestionar-paginas-base/noticias', [NewsPageAdminController::class, 'update'])->name('admin.pages.news.update');
    Route::resource('/admin/noticias', NewsAdminController::class)->parameters(['noticias' => 'news'])->names('admin.news')->except(['show']);

    // Pla de estudios
    Route::get('/gestionar-paginas-base/plan-estudio', [PlanEstudioPageAdminController::class, 'edit'])->name('admin.pages.plan.edit');
    Route::put('/gestionar-paginas-base/plan-estudio', [PlanEstudioPageAdminController::class, 'update'])->name('admin.pages.plan.update');

    // Perfil de egresado
    Route::get('/gestionar-paginas-base/perfil-egresado', [PerfilEgresadoPageAdminController::class, 'edit'])->name('admin.pages.perfil.edit');
    Route::put('/gestionar-paginas-base/perfil-egresado', [PerfilEgresadoPageAdminController::class, 'update'])->name('admin.pages.perfil.update');

    // Contacto
    Route::get('/gestionar-paginas-base/contacto', [ContactoPageAdminController::class, 'edit'])->name('admin.pages.contacto.edit');
    Route::put('/gestionar-paginas-base/contacto', [ContactoPageAdminController::class, 'update'])->name('admin.pages.contacto.update');

    // Descargas
    Route::get('/gestionar-paginas-base/descargas', [DescargasPageAdminController::class, 'edit'])->name('admin.pages.descargas.edit');
    Route::put('/gestionar-paginas-base/descargas', [DescargasPageAdminController::class, 'update'])->name('admin.pages.descargas.update');
    Route::resource('/admin/descargas', DownloadAdminController::class)->parameters(['descargas' => 'download'])->names('admin.downloads')->except(['show']);

    // Pre-egresados
    Route::get('/gestionar-paginas-base/pre-egresados', [PreEgresadosPageAdminController::class, 'edit'])->name('admin.pages.preegreso.edit');
    Route::put('/gestionar-paginas-base/pre-egresados', [PreEgresadosPageAdminController::class, 'update'])->name('admin.pages.preegreso.update');

    // Alumnis
    Route::get('/gestionar-paginas-base/alumnis', [AlumnisPageAdminController::class, 'edit'])->name('admin.pages.alumnis.edit');
    Route::put('/gestionar-paginas-base/alumnis', [AlumnisPageAdminController::class, 'update'])->name('admin.pages.alumnis.update');
    Route::resource('/admin/alumnis', AlumniAdminController::class)->parameters(['alumnis' => 'alumni'])->names('admin.alumnis')->except(['show']);

    // Galería
    Route::get('/gestionar-paginas-base/galeria', [GalleryPageAdminController::class, 'edit'])->name('admin.pages.gallery.edit');
    Route::put('/gestionar-paginas-base/galeria', [GalleryPageAdminController::class, 'update'])->name('admin.pages.gallery.update');
    Route::resource('/admin/galeria', GalleryAdminController::class)->parameters(['galeria' => 'gallery'])->names('admin.gallery')->except(['show']);
});


require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/descargas', [DownloadController::class, 'index'])->name('downloads.index');
Route::get('/descargas/archivo/{download}', [DownloadController::class, 'file'])->name('downloads.file');
Route::get('/alumnis', [AlumniController::class, 'index'])->name('alumnis.index');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/alumnis/{slug}', [AlumniController::class, 'show'])->name('alumnis.show');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/egresados', [HomeController::class, 'egresados'])->name('egresados.index');
Route::get('/egresados-parte-1', fn () => redirect()->route('egresados.index', status: 301));
Route::get('/egresados-parte-2', fn () => redirect()->route('egresados.index', status: 301));
Route::get('/perfil_egresado', fn () => redirect()->route('egresados.index', status: 301));
Route::get('/pre-egresados', fn () => redirect()->route('egresados.index', status: 301));
Route::get('/{slug}', [HomeController::class, 'show'])->name('page.show');
