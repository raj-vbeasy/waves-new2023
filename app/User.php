<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'name', 'email', 'password', 'folder_id', 'song_folder_id', 'sheet_id',
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
    ];

    final public function songs(): HasMany
    {
    	return $this->hasMany(Song::class);
    }

    final public function contract(): HasOne
    {
    	return $this->hasOne(Contract::class);
    }

    final public function promoAssets(): HasOne
    {
    	return $this->hasOne(PromoAssets::class);
    }

    final public function socialLinks(): HasOne
    {
    	return $this->hasOne(SocialLink::class);
    }
}
