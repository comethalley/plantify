<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierSeed extends Model
{
    use HasFactory;
    protected $fillable = [
        "supplier_id",
        "uom_id",
        "seed_id",
        "qty",
        "qr_code",
        "status"
    ];
}
