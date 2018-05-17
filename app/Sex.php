<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
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
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function plant()
	{
		return $this->hasOne( Plant::class );
	}
}
