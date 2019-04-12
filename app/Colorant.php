<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colorant extends Model
{
    protected $fillable = ['name'];
    public function recipes(){
        return $this->belongsToMany('App\Recipe', 'colorant_recipe');
    }
}
