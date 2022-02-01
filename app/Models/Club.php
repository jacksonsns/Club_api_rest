<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Club extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = "clubs";

    protected $fillable = [
        'nome',
        'descricao'
    ];

    use SoftDeletes;


    public function userJoin() {

        return $this->belongsTo('App\Models\User');
    }

}
