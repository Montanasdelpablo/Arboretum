<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function bloom_dates()
	{
		return $this->belongsToMany( Plant::class, 'bloom_month', 'month_id', 'plant_id' );
	}
}
