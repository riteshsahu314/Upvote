<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Filterable;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            $user->favorites->each->delete();
            $user->notifications->each->delete();
        });

        static::created(function($user) {
            $uniqueName = str_replace(' ', '.', strtolower($user->name)) . '.' . $user->id;

            $user = $user->update(['unique_name' => $uniqueName]);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_name', 'name', 'email', 'password', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['isAdmin'];

    public function getRouteKeyName()
    {
        return 'unique_name';
    }

    public function isAdmin()
    {
        return in_array(
            strtolower($this->email),
            array_map('strtolower', config('upvote.administrators'))
        );
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function getAvatarPathAttribute($avatar)
    {
        if ($avatar) {
            return Storage::url($avatar);
        } else {
            return Storage::url('avatars/default.png');
//            return asset('storage/avatars/default.png');    // TODO: remove this line
        }
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function identities() 
    {
        return $this->hasMany('App\SocialIdentity');
    }
}
