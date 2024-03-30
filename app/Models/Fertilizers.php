<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fertilizers extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fer_name',
        'fer_image',
        'fer_information',
        'fer_status'
    ];

    public function __construct(array $attributes = [])
    {
        // Call the parent constructor first
        parent::__construct($attributes);

        // Set the default status to 1 when creating a new instance
        $this->attributes['fer_status'] = 1;
    }
}
