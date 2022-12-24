<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongInfo extends Model
{
	protected $table = 'song_info';
    protected $fillable = ['publishing_splits', 'master_splits'];

    final public function song(): BelongsTo
    {
    	return $this->belongsTo(Song::class);
    }

	public function getPublishingSplitsAttribute($value)
	{
		return json_decode($value);
	}

	public function setPublishingSplitsAttribute($value)
	{
		if (empty($value)) {
			$value = [
				'name_1' => '',
				'number_1' => '',
				'name_2' => '',
				'number_2' => ''
			];
		}
		$this->attributes['publishing_splits'] = json_encode($value);
	}

	public function getMasterSplitsAttribute($value)
	{
		return json_decode($value);
	}

	public function setMasterSplitsAttribute($value)
	{
		if (empty($value)) {
			$value = [
				'name_1' => '',
				'number_1' => '',
				'name_2' => '',
				'number_2' => ''
			];
		}
		$this->attributes['master_splits'] = json_encode($value);
	}
}
