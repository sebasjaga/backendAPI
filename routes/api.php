<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Juegos_has_categoriaController;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    //Prefijo V1, todo lo que este dentro de este grupo se accedera escribiendo v1 en el navegador,
    // es decir /api/v1/*
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('categorias', [CategoryController::class, 'index']);
    Route::post('crearCategoria', [CategoryController::class, 'store']);
    Route::get('biblioteca', [BibliotecaController::class, 'index']);
    Route::get('roles', [RolesController::class, 'index']);
    Route::get('juegos_has_categoria', [juegos_has_categoriaController::class, 'index']);
    Route::get('juegos', [JuegosController::class, 'index']);
    Route::get('tienda', [TiendaController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);
    // Route::get('favorites', [FavoriteController::class, 'index']);
    // Route::get('favorites/{id}', [FavoriteController::class, 'show']);
    // Route::apiResource('categoria', CategoriaController::class);
    //Todo lo que este dentro de este grupo requiere verificación de usuario.
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('update-user', [AuthController::class, 'updateUser']);
        
    });
});