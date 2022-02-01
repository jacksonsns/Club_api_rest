<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use\Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    public function index() {
        
        $users = User::all();

        return $users;
    }

    public function register(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required',
            'cpf' => 'required|unique:users',
            'birth_date'=>'required',
            'dia_de_vencimento'=>'required'
        ]);

        $user = new User();
        $user-> name = $request->name;
        $user-> email = $request->email;
        $user-> password = Hash::make($request->password);
        $user-> cpf = $request->cpf;
        $user-> birth_date = $request->birth_date;
        $user-> dia_de_vencimento = $request->dia_de_vencimento;
        $user-> status = 'inativo';

        $user->save();

        return response()->json([
            "status" => 1,
            "msg" => "Usuário cadastrado com sucesso!"
        ]);
        
    }

    public function removerUsuario($id) {

        User::find($id)->delete();

        return response()->json([
            "msg" => "Usuário removido com sucesso!"
        ]);
    }

    public function recuperarUsuario($id) {

        User::withTrashed($id)->restore();

        return response()->json([
            "msg" => "Usuário recuperado com sucesso!"
        ]);
    }
    
    public function login(Request $request) {

        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        $user = User::where("email", "=", $request->email)->first();

        if(isset($user->id)) {

            if(Hash::check($request->password, $user->password)) {

                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([
                    "status" => 1,
                    "msg" => "Usuário logado com sucesso!",
                    "access_token" => $token
                ], 201);

            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "Email ou senha incorretos!"
                ], 404);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Usuário não registrado"
            ], 404);
        }
    }

    public function userProfile() {

        $user = auth()->user();

        $clubsAsParticipant = $user->clubsAsParticipant;

        return response()->json([
            "data" => $user
        ]);

    }

    public function logout() {

        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "msg" => "Usuário deslogado com sucesso!"
        ], 201);
    }

}
