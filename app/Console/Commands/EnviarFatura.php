<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fatura;
use App\Models\User;


class EnviarFatura extends Command
{
    
    protected $signature = 'task:EnvioDeFatura';


    protected $description = 'Este comando envia faturas para os usuários';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $dia_de_vencimento = date("d");
        $user = User::where('dia_de_vencimento', '=', $dia_de_vencimento)->get();

        $novaFatura = date('Y/m/d', strtotime('+28 days'));

        foreach($user as $users) {
            
            $fatura = new Fatura();

            $fatura->user_id = $users->id;
            $fatura->valor = '59.90';
            $fatura->vencimento = $novaFatura;
    
            $fatura->save();
        }
    }
}
