<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmArchive extends Model
{
    use HasFactory;

    protected $table = 'archivefarms';

    protected $fillable = [
        'old_id',
        'barangay_name',
        'farm_name',
        'address',
        'area',
        'farm_leader',
        'status',
        'title_land',
        'picture_land',
        // Add any additional columns if needed
    ];
}

