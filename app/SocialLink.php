<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['facebook', 'twitter', 'instagram', 'website', 'spotify', 'apple_music', 'sound_cloud'];
}
