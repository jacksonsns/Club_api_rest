<?php

namespace App\Http\Controllers\Api;

use App\Models\Club;
use App\Models\User;
use App\Models\Fatura;
use App\Http\Controllers\Controller;
use\Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClubController extends Controller
{

    public function index()
    {
        $clubs = Club::all();
        return $clubs;
    }

    public function criarClube(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:clubs',
            'descricao' => 'required'
        ]);

        $clubs = new Club();
        $clubs-> nome = $request->nome;
        $clubs-> descricao = $request->descricao;

        $clubs->save();

        return response()->json([
            "status" => 1,
            "msg" => "Clube cadastrado com sucesso!"
        ]);

    }

    public function update(Request $request, $id)
    {
        $club = Club::find($id);
        $club->update($request->all());
        return $club;

        return response()->json([
            "status" => 1,
            "msg" => "Clube atualizado com sucesso!"
        ]);
    }

    public function removerClub($id) {

        Club::find($id)->delete();

        return response()->json([
            "msg" => "Clube removido com sucesso!"
        ]);
    }

    public function recuperarClub($id) {

        Club::withTrashed($id)->restore();

        return response()->json([
            "msg" => "Clube recuperado com sucesso!"
        ]);
    }


    public function joinClub($id) {
        
        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {

            $userClubs = $user->clubsAsParticipant->toArray();

            foreach($userClubs as $userClub) {
                if($userClub['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

            if($hasUserJoined) {
                return response()->json([
                    'msg' => 'Você já está associado a este clube.'
                ]); 
            }

        }

        $fatura = new Fatura();

        $fatura->gerarFatura($user->id);

        $user->clubsAsParticipant()->attach($id);

        $club = Club::FindOrFail($id);

        return response()->json([
            "status" => 1,
            "msg" => "Associação feita com sucesso!"
        ]);  
    }


    public function leaveClub($id) {
        
        $user = auth()->user();

        $userAtivo = new User();

        $user->clubsAsParticipant()->detach($id);

        $club = Club::FindOrFail($id);

        $userAtivo->desativarUser($user->$id);

        return response()->json([
            "status" => 1,
            "msg" => "Desassociação feita com sucesso!"
        ]);  
    }

}

