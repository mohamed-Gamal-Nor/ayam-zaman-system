<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employees extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function section(){
        return $this->belongsTo('App\Models\sectionUSers');
    }
    public function advancePayment(){
        return $this->hasMany('App\Models\advancePayment','employees_id');
    }
    protected $dates=['deleted_at'];

}
