<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
	/**
	 * @var array
	 */
    protected $guarded = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function bloom_colors()
	{
		return $this->belongsToMany( Plant::class, 'bloom_color', 'color_id', 'plant_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function macule_colors()
	{
		return $this->belongsToMany( Plant::class, 'color_macule', 'color_id', 'plant_id' );
	}
}
