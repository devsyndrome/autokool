<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate_parts extends Model
{
    protected $guarded = [];  
    public $primaryKey = 'id_part';
    public function estimates()
    {
        return $this->belongsTo('App\Models\Estimates', 'id', 'id_estimates');
    }
}
