<?php

namespace App\Models\Zips;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Zips\CachedZipCodes;

class CachedZipSearches extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'timestamp', 'radius', 'zip_code',
    ];

    public function cachedZipCodes()
    {
        return $this->hasMany(CachedZipCodes::class, 'searches_id', 'id');
    }
}
