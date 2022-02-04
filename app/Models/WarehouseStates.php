<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zone_id',
        'status',
    ];

    public function zoneHouse(){
        return $this->belongsTo(Zone::class,'zone_id','id');
    }
}
