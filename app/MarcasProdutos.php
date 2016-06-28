<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcasProdutos extends Model {

    protected $table = 'marcas_produtos';

    protected $fillable = [
        'descricao', 'website', 'nome_fornecedor', 'email_fornecedor', 'telefone_fornecedor'
    ];

}
