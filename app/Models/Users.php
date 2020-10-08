<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Log;
use DB;

// Models
use App\Models\Categories\UsersCategories;

class Users extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
    ];

    public function categoriesIdsArray()
    {
        $categories_id = array();

        $users_categories = UsersCategories::where('users_id', $this->id)->get();
        if(!is_null($users_categories))
        {
            $categories_id = $users_categories->pluck('categories_id')->toArray();
        }

        return $categories_id;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
        Log::info('Reset Password Notification generated for user.', [
            'user_id' => $this->id,
            'email' => $this->email,
        ]);
    }

    /**
     * Generate a new password reset token
     *
     * @param void
     * @return void
     */
    public function newResetPasswordToken()
    {
        return app('auth.password.broker')->createToken($this);
    }

    public function toggleNSFW()
    {
        $this->show_nsfw = !$this->show_nsfw;
    }
}
