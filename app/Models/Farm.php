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
        'area',
        'farm_leader',
        'status',
        'title_land',
        'picture_land',
        'picture_land1',
        'picture_land2',
        'select_date',
    ];
    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'farm_id', 'id');
    }

    public function scopeWithBarangayName($query, $barangayId = null)
    {
        $query->select(['id', 'farm_name'])
            ->when($barangayId, function ($query, $barangayId) {
                $query->where('barangay_id', $barangayId);
            });
    }
    public function users()
    {
        return $this->hasMany(User::class, 'farm_leader');
    }
}
