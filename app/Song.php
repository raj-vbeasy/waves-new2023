<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Song extends Model
{
    protected $fillable = ['name', 'folder_id'];

    final public function info(): HasOne
    {
    	return $this->hasOne(SongInfo::class);
    }

    final public function assets(): HasOne
    {
    	return $this->hasOne(SongAssets::class);
    }
}
