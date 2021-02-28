<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    protected $dates=['deleted_at'];
    public function invoices(){
        return $this->hasMany('App\Models\invoices','supplier_id');
    }
    public function pays(){
        return $this->hasMany('App\Models\supplierPay','supplier_id');
    }
}