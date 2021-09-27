<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate_services extends Model
{
    protected $guarded = [];  
    public $primaryKey = 'id_services';
    public function estimates()
    {
        return $this->belongsTo('App\Models\Estimates', 'id', 'id_estimates');
    }
}
