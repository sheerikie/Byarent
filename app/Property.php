<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $table = "properties";
    //public $timestamps = false;
    public $fillable = ['name','description','pictures','type','price'];

    public function pictures(){

        return $this->belongsToMany(Picture::class);
    }

}


