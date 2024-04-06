<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    public function farms()
    {
        return $this->hasMany(Farm::class, 'barangay_name', 'barangay_name');
    }
}
