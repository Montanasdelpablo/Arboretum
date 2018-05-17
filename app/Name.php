<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
	/**
	 * @var array
	 */
    protected $guarded = ['id'];
	/**
	 * @var bool
	 */
    public $timestamps = false;

    public function plant()
	{
		return $this->hasOne( Plant::class );
	}
}
