<?php

namespace App\Models\Posters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posters extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];
}
