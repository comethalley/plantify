<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions_table'; // Pangalan ng table sa database

    protected $fillable = ['question']; // Mga column na maaring i-fill
}
