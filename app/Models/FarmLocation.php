<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmLocation extends Model
{
    use HasFactory;
    protected $table = 'farm_locations';
    protected $fillable = [
        "latitude",
        "longitude",
        "location_name",
        "address",
        "status",
    ];
    public function farmLeader()
    {
        // Assuming 'farm_leader' is the foreign key in the farm_locations table
        return $this->belongsTo(User::class, 'id');
    }
}
