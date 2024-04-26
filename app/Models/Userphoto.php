<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_photo',
        'cover_photo',
        'bio', // Bagong field
        'address', // Bagong field
        'email', // Bagong field
        'facebook', // Bagong field
        'instagram', // Bagong field
        'twitter', // Bagong field
    ];
}
