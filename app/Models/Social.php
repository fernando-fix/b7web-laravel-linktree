<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'socials';
    protected $fillable = [
        'title',
        'image',
    ];

    public function links()
    {
        return $this->hasMany(Social::class);
    }
}
