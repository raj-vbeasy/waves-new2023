<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoAssets extends Model
{
    protected $table = 'promo_assets';

    protected $fillable = ['bio', 'one_sheet', 'promo_pics', 'folder_id'];

	public function setPromoPicsAttribute($value)
	{
		if (empty($value)) {
			$value = [];
		}
		$this->attributes['promo_pics'] = json_encode($value);
	}

	public function getPromoPicsAttribute($value)
	{
		return json_decode($value);
	}
}
