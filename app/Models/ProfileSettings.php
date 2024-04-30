<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSettings extends Model
{
    use HasFactory;

    protected $table = 'profilesettings'; // Pangalang ng table

    protected $fillable = [
        'user_id',
        'cover_image',
        'profile_image',


        // Dagdag na mga field dito kung kinakailangan
    ];

    // Dito mo maaaring ilagay ang anumang mga custom functions o relasyon
}
