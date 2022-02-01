<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fatura;
use App\Models\User;


class VerificarFatura extends Command
{
    
    protected $signature = 'task:VerificarFaturas';


    protected $description = 'Este comando envia faturas para os usuários';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $data_de_vencimento = date("Y-m-d");

        $fatura = Fatura::where('vencimento', '=', $data_de_vencimento)
                        ->where('status', '=', 'a vencer')->get();


        foreach($fatura as $faturas) {
            $faturas->update([
                'status' => 'vencida'
            ]);
    
            $usuarioStatus = User::where('id', '=', $faturas->user_id);
    
            $usuarioStatus->update([
                'status' => 'inadimplente'
            ]);
        }

    }
}
