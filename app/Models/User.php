<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $dates = ['deleted_at'];
    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
        'birth_date',
        'dia_de_vencimento',
        'club_id'
    ];

    use SoftDeletes;

    public function clubsAsParticipant() {

        return $this->belongsToMany('App\Models\Club');
    }

    public function ativarUser($id) {

        $associar = User::where('id', $id);

        $associar->update([
            'status' => 'ativo'
        ]);
         
    }

    public function desativarUser($id) {

        $associar = User::where('id', $id);

        $associar->update([
            'status' => 'inativo'
        ]);
         
    }

}
