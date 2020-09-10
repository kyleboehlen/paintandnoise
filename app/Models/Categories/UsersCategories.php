<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

class UsersCategories extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ['categories_id', 'users_id'];
}
