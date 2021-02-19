<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materials extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function unit(){
        return $this->belongsTo('App\Models\materialsUnit');
    }
    public function purchases(){
        return $this->belongsToMany('App\Models\purchases','material_id');
    }
}
