<?php

use App\Http\Controllers\CompetitividadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\MatriculaIgualdadGeneroController;
use App\Http\Controllers\MatriculaInclusionController;
use App\Http\Controllers\MatriculaInterculturalidadController;
use App\Http\Controllers\CapacidadController;
use App\Http\Controllers\SeguimientoTrayectoriaController;
use App\Http\Controllers\UnidadAcademicaController;
use App\Http\Controllers\ProgramaEducativoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FechaCorteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CorteCajaController;
use App\Http\Controllers\GastosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

// Página de inicio para usuarios registrados
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Rutas para el módulo de matrícula, solo accesibles si el usuario está autenticado
Route::middleware(['auth'])->group(function () {
    // Rutas de matrícula //Route::resource('matricula', MatriculaController::class);
    Route::controller(MatriculaController::class)->prefix('matricula')->name('matricula.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/report', 'report')->name('report');

        Route::controller(MatriculaIgualdadGeneroController::class)->prefix('igualdad-genero')->name('igualdad-genero.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::get('/{matricula}/edit', 'edit')->name('edit');
            Route::put('/{matricula}', 'update')->name('update');
            Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
            Route::get('/report', 'report')->name('report');
            Route::get('/import-form', 'showImportForm')->name('import-form');
            Route::post('/import',  'import')->name('import');
            Route::get('/generate-excel', 'generateExcel')->name('generate.excel');
            Route::get('/exportar-excel', 'exportToExcel')->name('export-excel');
            Route::get('/exportar-pdf', 'exportToPdf')->name('export-pdf');
        });
        Route::controller(MatriculaInclusionController::class)->prefix('inclusion')->name('inclusion.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::get('/{matricula}/edit', 'edit')->name('edit');
            Route::put('/{matricula}', 'update')->name('update');
            Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
            Route::get('/report', 'report')->name('report');
            Route::get('/import-form', 'showImportForm')->name('import-form');
            Route::post('/import',  'import')->name('import');
            Route::get('/generate-excel', 'generateExcel')->name('generate.excel');
            Route::get('/exportar-excel', 'exportToExcel')->name('export-excel');
            Route::get('/exportar-pdf', 'exportToPdf')->name('export-pdf');
        });
        Route::controller(MatriculaInterculturalidadController::class)->prefix('interculturalidad')->name('interculturalidad.')->group(function () {

            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{matricula}/edit', 'edit')->name('edit');
            Route::put('/{matricula}', 'update')->name('update');
            Route::get('/report', 'report')->name('report');
            Route::get('/import-form', 'showImportForm')->name('import-form');
            Route::post('/import',  'import')->name('import');
            Route::get('/generate-excel', 'generateExcel')->name('generate.excel');
            Route::get('/exportar-excel', 'exportToExcel')->name('export-excel');
            Route::get('/exportar-pdf', 'exportToPdf')->name('export-pdf');


            //Route::get('/interculturalidad', [MatriculaInterculturalidadController::class, 'index'])->name('interculturalidad');
            //Route::get('/interculturalidad/create', [MatriculaInterculturalidadController::class, 'create'])->name('interculturalidad.create');
            //Route::post('/interculturalidad', [MatriculaInterculturalidadController::class, 'store'])->name('interculturalidad.store');
            //Route::get('/interculturalidad/{matricula}/edit', [MatriculaInterculturalidadController::class, 'edit'])->name('interculturalidad.edit');
            //Route::put('/interculturalidad/{matricula}', [MatriculaInterculturalidadController::class, 'update'])->name('interculturalidad.update');
        });
    });

    Route::controller(SeguimientoTrayectoriaController::class)->prefix('seguimiento-trayectoria')->name('seguimiento-trayectoria.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store/{id}', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(CapacidadController::class)->prefix('capacidad')->name('capacidad.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store/{id}', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(CompetitividadController::class)->prefix('competitividad')->name('competitividad.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store/{id}', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(UnidadAcademicaController::class)->prefix('unidad-academica')->name('unidad-academica.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{unidad_academica}/edit', 'edit')->name('edit');
        Route::put('/update/{unidad_academica}', 'update')->name('update');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(ProgramaEducativoController::class)->prefix('programas-educativos')->name('programas-educativos.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{programa_educativo}/edit', 'edit')->name('edit');
        Route::put('/update/{programa_educativo}', 'update')->name('update');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(UsuarioController::class)->prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::get('/{usuario}/edit', 'edit')->name('edit');
        Route::put('/{usuario}', 'update')->name('update');
        Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
        Route::get('/report', 'report')->name('report');
    });

    Route::controller(BitacoraController::class)->prefix('bitacora')->name('bitacora.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/report', 'report')->name('report');
        Route::post('/buscar', 'buscar')->name('buscar');
    });
    Route::controller(FechaCorteController::class)->prefix('fechas-corte')->name('fechas-corte.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update'); 
        Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
    });

    Route::controller(ProveedorController::class)->group(function () {
        Route::get('proveedores', 'index')->name('proveedores.index');
        Route::post('proveedores', 'store')->name('proveedores.store');
        Route::put('proveedores/{proveedor}', 'update')->name('proveedores.update');
        Route::delete('proveedores/{proveedor}', 'destroy')->name('proveedores.destroy');
    });



    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

        Route::resource('ventas', VentaController::class);

        Route::get('corte-caja', [CorteCajaController::class, 'index'])->name('corte_caja.index');
Route::post('corte-caja', [CorteCajaController::class, 'store'])->name('corte_caja.store');
Route::resource('ventas', VentaController::class);
Route::get('corte-caja', [CorteCajaController::class, 'index'])->name('corte_caja.index');
Route::post('corte-caja/cerrar', [CorteCajaController::class, 'cerrarCorte'])->name('corte_caja.cerrar');

Route::get('/gastos', [GastosController::class, 'index'])->name('gastos.index');
});
