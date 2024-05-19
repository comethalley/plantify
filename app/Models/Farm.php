<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'barangay_name',
        'farm_name',
        'address',
        'area',
        'farm_leader',
        'status'
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_name', 'barangay_name');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'farm_leader');
    }
    
    public function farmLeader()
    {
        return $this->belongsTo(User::class, 'farm_leader');
    }

    public function farmers()
    {
        return $this->hasMany(Farmer::class, 'farmleader_id');
    }

    public function requests()
    {
        return $this->hasMany(RequestN::class, 'farm_id');
    }
}
