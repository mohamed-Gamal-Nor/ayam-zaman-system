<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class closingSalary extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function employees(){
        return $this->belongsTo('App\Models\employees');
    }
}
