<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'title',
        'btn_color',
        'text_color',
        'bg_color1',
        'bg_color2',
        'angle',
    ];
}
