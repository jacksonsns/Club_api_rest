<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\FaturaController;


// Rotas Usuário
Route::get('listar_usuarios', [UserController::class, 'index']);
Route::post('login', [UserController::class, 'login']);
Route::post('registrar', [UserController::class, 'register']);

// Soft Delete apagar usuário
Route::get('apagar_usuario/{id}', [UserController::class, 'removerUsuario']);

// Restaurar usuários apagados
Route::get('recuperar_usuario/{id}', [UserController::class, 'recuperarUsuario']);

Route::group(['middleware' => ["auth:sanctum"]], function() {
    Route::get('usuario/perfil', [UserController::class, 'userProfile']);
    Route::get('usuario/sair', [UserController::class, 'logout']);
    Route::put('usuarios/alterar/{id}', [AdminController::class, 'update']);
});


// Rotas de Clubes
Route::group(['middleware' => ["auth:sanctum"]], function() {
    Route::post('associar/{id}', [ClubController::class, 'joinClub']);
    Route::delete('desassociar/{id}', [ClubController::class, 'leaveClub']);
});

Route::get('clubes', [ClubController::class,'index']);
Route::post('cadastrar_clube', [ClubController::class,'criarClube']);
Route::put('clubes/{id}', [ClubController::class,'update']);
Route::delete('clubes/{id}', [ClubController::class,'destroy']);

// Soft Delete apagar clube
Route::get('apagar_clube/{id}', [ClubController::class, 'removerClub']);

// Restaurar clubes apagados
Route::get('recuperar_clube/{id}', [ClubController::class, 'recuperarClub']);


// Rota Fatura
Route::get('fatura/{id}', [FaturaController::class, 'showFatura']);
Route::put('fatura/pagar/{id}', [FaturaController::class,'pagarFatura']);

