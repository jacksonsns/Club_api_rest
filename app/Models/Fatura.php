<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $table = "fatura";

    protected $fillable = [
        'user_id',
        'valor',
        'status',
        'vencimento'
    ];

    public function gerarFatura($id) { 
        
        $fatura = new Fatura();
        $fatura-> user_id = $id;
        $fatura-> valor = '59.90';
        $fatura-> vencimento = date('Y/m/d', strtotime('+29 days'));

        $fatura->save();

        return response()->json([
            "status" => 1,
            "msg" => "fatura gerada com sucesso!"
        ]);
       
    }



}
