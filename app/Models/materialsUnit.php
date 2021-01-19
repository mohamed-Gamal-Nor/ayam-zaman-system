<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialsUnit extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function materials(){
        return $this->hasMany('App\Models\materials','unit_id');
    }
}