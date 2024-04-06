<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'plant_name',
        'image',
        'seasons',
        'information',
        'companion',
        'days_harvest',
        'status'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set the default status to 1 when creating a new instance
        $this->attributes['status'] = 1;
    }
}
