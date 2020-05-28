<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'point', 'words'
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
        'is_admin' => 'boolean'
    ];

    public function scopeisAdmin($query)
    {
        return $query->where('is_admin', 1);
    }

    public function scopeisUser($query)
    {
        return $query->where('is_admin', 0);
    }

    public function histories()
    {
        return $this->hasMany('App\History', 'user_id', 'id');
    }

    public function getWordsCountAttribute()
    {
        $array = explode(',', $this->words);

        return count($array) - 1;
    }
}
