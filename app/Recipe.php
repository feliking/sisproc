<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function colorants(){
        return $this->belongsToMany('App\Colorant', 'colorant_recipe');
    }

    public function assistants(){
        return $this->belongsToMany('App\Assistant', 'assistant_recipe');
    }
}
