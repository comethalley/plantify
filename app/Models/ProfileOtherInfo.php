<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileOtherInfo extends Model
{
    use HasFactory;

    protected $table = 'profileotherinfo'; // Pangalang ng iyong table

    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'instagram',
        'city',
        'age',
        'sex',
        'bio',
        // Iba pang mga field na nais mong maging fillable
    ];

    // Dito mo maaaring ilagay ang anumang mga custom functions o relasyon
}
