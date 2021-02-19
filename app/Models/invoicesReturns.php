<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoicesReturns extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function supplier(){
        return $this->belongsTo('App\Models\Suppliers');
    }
    public function store(){
        return $this->belongsTo('App\Models\stores');
    }
    public function purchesReturns(){
        return $this->hasMany('App\Models\PurchaseReturns','invoice_id');
    }
}