<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongAssets extends Model
{
    protected $table = 'song_assets';

    protected $fillable = ['full_track', 'instrumental', 'clean', 'steam'];

    final public function song(): BelongsTo
    {
    	return $this->belongsTo(Song::class);
    }
}
