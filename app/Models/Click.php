<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $table = 'clicks';
    protected $fillable = [
        'link_id',
        'ip',
        'date'
    ];
}
