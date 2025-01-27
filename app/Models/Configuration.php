<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['config_name', 'config_data'];

    protected $casts = [
        'config_data' => 'array',
    ];
}