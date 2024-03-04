<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'budget_id', 'description', 'amount', 'image_path'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
