<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicData extends Model
{
    protected $table = 'basic_data';

    protected $fillable = [
        'value',
    ];
}