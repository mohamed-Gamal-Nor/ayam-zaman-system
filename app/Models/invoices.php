<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function supplier(){
        return $this->belongsTo('App\Models\materialsUnit');
    }
    public function purches(){
        return $this->hasMany('App\Models\purchases','invoice_id');
    }
}