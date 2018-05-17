<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = [ 'id' ];

	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @var array
	 */
	protected $with = [ 'name', 'bloom_colors', 'macule_colors', 'crossing', 'group', 'months', 'priority', 'sex', 'size', 'specie', 'supplier', 'synonym', 'treetype', 'type', 'variety', 'winner' ];
	/**
	 * @var array
	 */
	protected $casts = [ 'bloom_color', 'months', 'macule_color' ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function name()
	{
		return $this->belongsTo( Name::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function type()
	{
		return $this->belongsTo( Type::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sex()
	{
		return $this->belongsTo( Sex::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function specie()
	{
		return $this->belongsTo( Specie::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function variety()
	{
		return $this->belongsTo( Variety::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group()
	{
		return $this->belongsTo( Group::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function synonym()
	{
		return $this->belongsTo( Synonym::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function crossing()
	{
		return $this->belongsTo( Crossing::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function winner()
	{
		return $this->belongsTo( Winner::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function treetype()
	{
		return $this->belongsTo( Treetype::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function priority()
	{
		return $this->belongsTo( Priority::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function supplier()
	{
		return $this->belongsTo( Supplier::class );
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
	public function months()
	{
		return $this->belongsToMany( Month::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function macule_colors()
	{
		return $this->belongsToMany( Color::class, 'color_macule', 'plant_id', 'color_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function size()
	{
		return $this->belongsTo( Size::class );
	}
}
