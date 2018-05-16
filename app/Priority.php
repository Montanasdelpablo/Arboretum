<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function plant()
	{
		return $this->hasOne( Plant::class );
	}
}
