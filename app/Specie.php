<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function plant()
	{
		return $this->belongsTo( Plant::class );
	}
}
