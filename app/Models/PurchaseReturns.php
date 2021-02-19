<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturns extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function invoiceReturns(){
        return $this->belongsTo('App\Models\invoicesReturns');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Suppliers');
    }
    public function material(){
        return $this->belongsTo('App\Models\materials');
    }
    public function store(){
        return $this->belongsTo('App\Models\stores');
    }
}
