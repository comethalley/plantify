<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // I-set ang table name kung kinakailangan
    protected $table = 'reports';

    // I-configure ang mga fillable o guarded fields depende sa iyong pangangailangan
    protected $fillable = ['content']; // assuming 'content' ang pangalan ng column
}
