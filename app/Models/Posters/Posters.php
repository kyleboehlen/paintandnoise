<?php

namespace App\Models\Posters;

use Illuminate\Database\Eloquent\Model;

class Posters extends Model
{
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];
}
