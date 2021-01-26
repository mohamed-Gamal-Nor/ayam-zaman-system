<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchases extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function invoice(){
        return $this->belongsTo('App\Models\invoices');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Suppliers');
    }
    public function material(){
        return $this->belongsTo('App\Models\materials');
    }
}