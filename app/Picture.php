<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public $table = "pictures";
    public $timestamps = false;
    public $fillable = ['pictures','property_id'];

    public function properties(){

        return $this->belongsToMany(Property::class);
    }

}
