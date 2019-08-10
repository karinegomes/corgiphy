<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string username
 * @property string email
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'username', 'password', 'api_token'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getForApi()
    {
        return [
            'username' => $this->username,
            'email'    => $this->email,
        ];
    }
}
