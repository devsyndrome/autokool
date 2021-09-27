<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    protected $guarded = [];  
    public $primaryKey = 'id';
    public function estimate_parts()
    {
        return $this->hasMany('App\Models\Estimate_parts', 'id', 'id_estimates');
    }
    public function estimate_services()
    {
        return $this->hasMany('App\Models\Estimate_services', 'id', 'id_estimates');
    }
}
