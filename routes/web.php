<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gestionarticulo;
use App\Http\Controllers\gestioncategoria;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\categoriasImport;
use App\Exports\categoriasExport;
use App\Exports\articulosExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () { return view('welcome'); });
Route::get('/', [gestioncategoria::class, 'getcategoriaswelcome']);
// Route::get('/aretes', function () { return view('aretes'); });

Route::post('/busqueda', [gestionarticulo::class, 'getbusqueda']);
Route::get('/creaproducto', [gestionarticulo::class, 'getcategorias']);
Route::get('/producto/{id}', [gestionarticulo::class, 'getarticulo']);
Route::get('/verarticulos', [gestionarticulo::class, 'getarticulos']);
Route::get('/eliminar/{id}', [gestionarticulo::class, 'eliminararticulo']);
Route::get('/editaproducto/{id}', [gestionarticulo::class, 'muestraeditararticulo']);
Route::post('/guardararticulo', [gestionarticulo::class, 'guardararticulo']); //Funciona
Route::post('/guardaredicionarticulo', [gestionarticulo::class, 'guardaredicionarticulo']);

Route::get('/administracategorias', [gestioncategoria::class, 'getcategorias']);
Route::post('/creacat', [gestioncategoria::class, 'guardarcategoria']);
Route::get('/eliminacategoria/{id}', [gestioncategoria::class, 'eliminacategoria']);
Route::post('/guardarcambios', [gestioncategoria::class, 'guardaredicion']);
Route::get('/categoria/{id}', [gestioncategoria::class, 'getcategoria']);
Route::get('/categoriaindice', [gestioncategoria::class, 'getcategoriasindice']);

Route::post('/generapdf', [gestionarticulo::class, 'generapdf']);
Route::post('/importcat', [gestioncategoria::class, 'importcat']);
Route::get('/exportcat', [gestioncategoria::class, 'exportcat']);
Route::get('/exportart', [gestionarticulo::class, 'exportart']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
