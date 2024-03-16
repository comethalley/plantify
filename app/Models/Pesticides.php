<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesticides extends Model
{
    use HasFactory;
    protected $fillable = [
        'pes_name',
        'pes_image',
        'pes_information',
        'pes_status'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set the default status to 1 when creating a new instance
        $this->attributes['status'] = 1;
    }
}
