<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colorant extends Model
{
    public function recipes(){
        return $this->belongsToMany('App\Recipe', 'colorant_recipe');
    }
}
