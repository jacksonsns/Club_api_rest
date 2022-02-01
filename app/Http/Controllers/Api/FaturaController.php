<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fatura;
use App\Models\User;

class FaturaController extends Controller

{
    public function showFatura($id) {

        $fatura = Fatura::findOrFail($id);
        $user = auth()->user();

        return $fatura;
    }

    public function pagarFatura($id) {

        $status = "paga";

        $verificarFatura = Fatura::where('id', $id)->first();

        if($verificarFatura->status == $status) {

            return response()->json([
                "msg" => "Essa fatura já foi paga."
            ]);  
        }

        $statusUser = new User();
        
        $statusUser->ativarUser($verificarFatura->user_id);

        $faturaAberta = Fatura::where('id', $id);

        $faturaAberta->update(['status' => $status]);

        return response()->json([
            "msg" => "fatura paga com sucesso!"
        ]);        
         
    }

}
