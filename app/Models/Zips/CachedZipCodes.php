<?php

namespace App\Models\Zips;

use Illuminate\Database\Eloquent\Model;

class CachedZipCodes extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'searches_id', 'zip_code',
    ];
}
