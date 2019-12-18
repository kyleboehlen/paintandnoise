<?php

namespace App\Models\Categories;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

use Illuminate\Database\Eloquent\Model;

class UsersCategories extends Model
{
    use HasCompositePrimaryKey;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ['categories_id', 'users_id'];
}
