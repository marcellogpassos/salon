<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContasExcluidas extends Model {

    protected $table = 'contas_excluidas';

    protected $fillable = [
        'email', 'telefone', 'motivo', 'stars'
    ];

}