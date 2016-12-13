<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    const ADMIN = 1;
    const CABLR = 2;
    const MAQDR = 3;
    const ESTCT = 4;
    const MANPE = 5;
    const CAIXA = 6;
    const BARBR = 7;

    public function users() {
        return $this->belongsToMany('App\User');
    }

}
