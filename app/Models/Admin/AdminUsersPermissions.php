<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

class AdminUsersPermissions extends Model
{
    use SoftDeletes;
    use HasCompositePrimaryKey;

    protected $primaryKey = ['admin_users_id', 'admin_permissions_id'];

    public $incrementing = false;
    public $fillable = [
        'admin_users_id',
        'admin_permissions_id',
        'expires',
    ];
}
