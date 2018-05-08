<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
	/**
	 * @var array
	 */
    protected $guarded = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function type()
	{
		return $this->hasOne( Type::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function sex()
	{
		return $this->hasOne( Sex::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function specie()
	{
		return $this->hasOne( Specie::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function variety()
	{
		return $this->hasOne( Variety::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function group()
	{
		return $this->hasOne( Group::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function synonym()
	{
		return $this->hasOne( Synonym::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function crossing()
	{
		return $this->hasOne( Crossing::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function winner()
	{
		return $this->hasOne( Winner::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function treetype()
	{
		return $this->hasOne( Treetype::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function priority()
	{
		return $this->hasOne( Priority::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function supplier()
	{
		return $this->hasOne( Supplier::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function bloom_colors()
	{
		return $this->belongsToMany( Color::class, 'bloom_color', 'plant_id', 'color_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function bloom_dates()
	{
		return $this->belongsToMany( Month::class, 'bloom_month', 'plant_id', 'month_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function macule_colors()
	{
		return $this->belongsToMany( Color::class, 'color_macule', 'plant_id', 'color_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function size()
	{
		return $this->hasOne( Size::class );
	}
}
