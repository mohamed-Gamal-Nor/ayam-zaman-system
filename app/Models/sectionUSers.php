<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectionUSers extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->hasMany('App\Models\User','section_id');
    }
    public function employees(){
        return $this->hasMany('App\Models\employees','section_id');
    }
}
