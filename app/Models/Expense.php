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

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($expense) {
            if ($expense->user && $expense->user->role_id == 3 && !$expense->budget_id) {
                $expense->budget_id = 3;
            }
        });
    }
    
}

