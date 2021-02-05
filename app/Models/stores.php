<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function invoices(){
        return $this->hasMany('App\Models\invoices','store_id');
    }
    public function materail(){
        return $this->hasMany('App\Models\materials','store_id');
    }
}
