<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayArchive extends Model
{
    use HasFactory;

    protected $table = 'barangays_archive';

    protected $fillable = [
        'barangay_name',
        // Add any additional columns if needed
    ];
}
