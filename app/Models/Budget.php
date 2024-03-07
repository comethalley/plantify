<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'farm_id', 'allotted_budget', 'balance', 'total_expenses'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
