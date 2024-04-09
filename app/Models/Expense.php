<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'farm_id', 'budget_id', 'category_id', 'description', 'current_rdg', 'amount', 'image_path'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
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
