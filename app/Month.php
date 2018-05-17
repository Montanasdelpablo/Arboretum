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
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function plants()
	{
		return $this->belongsToMany( Plant::class );
	}
}
