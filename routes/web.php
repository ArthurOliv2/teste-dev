<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContatoController;

Route::get('/', [ContatoController::class, 'index']);
Route::resource('contatos', ContatoController::class);
Route::get('/contatos/{contato}/endereco', function (App\Models\Contato $contato) {
    return response()->json([
        'cep' => $contato->endereco->cep ?? '-',
        'rua' => $contato->endereco->rua ?? '-',
        'numero' => $contato->endereco->numero ?? '-',
        'complemento' => $contato->endereco->complemento ?? '-',
        'cidade' => $contato->endereco->cidade ?? '-',
        'estado' => $contato->endereco->estado ?? '-',
    ]);
});