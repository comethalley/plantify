<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantifeed extends Model
{
    use HasFactory;

    protected $fillable = [
            "post_title",
            "body",
            "image",
            "createdby",
            "status",
    ];
}
