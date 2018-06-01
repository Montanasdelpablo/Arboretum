<?php

namespace App\Http\Controllers;

use App\Plant;
use Faker\Provider\Image;
use Illuminate\Http\Request;

class PlantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Plant::all() );
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request )
	{
		// Convert base64 image into file
		if( !empty( $request->file('image') ) )
		{
			$request->merge( [ 'image' => $this->convertImage( $request->input('image') ) ] );

		}

		$this->validation( $request );

		// Upload image and add path into request array
		if( !empty( $request->file('image') ) )
		{
			$request->merge( [ 'image' => $this->convertImage( $request->file('image') ) ] );
			$path = $request->file('image')->store('plants');
			$request->merge( [ 'image' => $path ] );
		}

		$created = Plant::create( [
			'name_id'         => $request->input( 'name_id' ),
			'follow_number'   => $request->input( 'follow_number' ),
			'purchase_number' => $request->input( 'purchase_number' ),
			'control'         => $request->input( 'control' ),
			'place'           => $request->input( 'place' ),
			'latitude'        => $request->input( 'latitude' ),
			'longitude'       => $request->input( 'longitude' ),
			'replant'         => $request->input( 'replant' ),
			'moved'           => $request->input( 'moved' ),
			'dead'            => $request->input( 'dead' ),
			'planted'         => $request->input( 'planted' ),
			'note'            => $request->input( 'note' ),
			'description'     => $request->input( 'description' ),
			'type_id'         => $request->input( 'type_id' ),
			'sex_id'          => $request->input( 'sex_id' ),
			'specie_id'       => $request->input( 'specie_id' ),
			'subspecie_id'    => $request->input( 'subspecie_id' ),
			'group_id'        => $request->input( 'group_id' ),
			'synonym_id'      => $request->input( 'synonym_id' ),
			'crossing_id'     => $request->input( 'crossing_id' ),
			'winner_id'       => $request->input( 'winner_id' ),
			'treetype_id'     => $request->input( 'treetype_id' ),
			'priority_id'     => $request->input( 'priority_id' ),
			'supplier_id'     => $request->input( 'supplier_id' ),
			'size_id'         => $request->input( 'size_id' ),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		] );



		// Add bloom colors
		if( !empty( $request->bloom_colors ) ) {
			$created->bloom_colors()->attach( $request->bloom_colors );
		}

		// Add bloom date
		if( !empty( $request->months ) ) {
			$created->months()->attach( $request->months );
		}

		// Add bloom date
		if( !empty( $request->macule_colors ) ) {
			$created->macule_colors()->attach( $request->macule_colors );
		}

		if( $created ) {
			return response()->json( [ 'success' => true, 'message' => 'Plant created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not created' ], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Plant $plant
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Plant $plant )
	{
		return response()->json( $plant, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Plant $plant
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Plant $plant )
	{
		return response()->json( $plant, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Plant               $plant
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Plant $plant )
	{
		$this->validation( $request );

		$updated = $plant->update( [
			'name_id'         => $request->input( 'name_id' ),
			'follow_number'   => $request->input( 'follow_number' ),
			'purchase_number' => $request->input( 'purchase_number' ),
			'control'         => $request->input( 'control' ),
			'place'           => $request->input( 'place' ),
			'latitude'        => $request->input( 'latitude' ),
			'longitude'       => $request->input( 'longitude' ),
			'replant'         => $request->input( 'replant' ),
			'moved'           => $request->input( 'moved' ),
			'dead'            => $request->input( 'dead' ),
			'planted'         => $request->input( 'planted' ),
			'note'            => $request->input( 'note' ),
			'description'     => $request->input( 'description' ),
			'type_id'         => $request->input( 'type_id' ),
			'sex_id'          => $request->input( 'sex_id' ),
			'specie_id'       => $request->input( 'specie_id' ),
			'subspecie_id'    => $request->input( 'subspecie_id' ),
			'group_id'        => $request->input( 'group_id' ),
			'synonym_id'      => $request->input( 'synonym_id' ),
			'crossing_id'     => $request->input( 'crossing_id' ),
			'winner_id'       => $request->input( 'winner_id' ),
			'treetype_id'     => $request->input( 'treetype_id' ),
			'priority_id'     => $request->input( 'priority_id' ),
			'supplier_id'     => $request->input( 'supplier_id' ),
			'size_id'         => $request->input( 'size_id' ),
			'updated_at' => date('Y-m-d H:i:s')
		] );

		// Add bloom colors
		if( !empty( $request->bloom_colors ) ) {
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->bloom_colors as $bloom_color )
			{
				if( is_array( $bloom_color ) )
				{
					$colors[] = $bloom_color[ 'id' ];
				} else {
					$colors = $request->bloom_colors;
				}
			}

			$plant->bloom_colors()->sync( $colors );
		}

		// Add bloom date
		if( !empty( $request->months ) ) {
			$months = [];

			/*
			 * $request->months can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->months as $month )
			{
				if( is_array( $month ) )
				{
					$months[] = $month[ 'id' ];
				} else {
					$months = $request->months;
				}
			}

			$plant->months()->sync( $months );
		}

		// Add bloom date
		if( !empty( $request->macule_colors ) ) {
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->macule_colors as $macule_color )
			{
				if( is_array( $macule_color ) )
				{
					$colors[] = $macule_color[ 'id' ];
				} else {
					$colors = $request->macule_colors;
				}
			}

			$plant->macule_colors()->sync( $colors );
		}

		if( $updated ) {
			return response()->json( [ 'success' => true, 'message' => 'Plant updated', 'result' => $updated ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Plant $plant
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Plant $plant )
	{
		$destroyed = $plant->delete();

		if( $destroyed ) {
			return response()->json( [ 'success' => true, 'message' => 'Plant deleted', 'result' => $plant ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not deleted' ], 400 );
		}
	}

	/**
	 * Search for resource in storage
	 *
	 * @param $search
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function search( $search )
	{
		$results = Plant::where( 'name', 'like', '%'.$search.'%' )
			->orWhere( 'id', $search )
			->get();

		return response()->json( $results, 200 );
	}

	/**
	 * Validate input
	 *
	 * @param \Illuminate\Http\Request $request
	 */
	private function validation( Request $request )
	{
		$request->validate( [
			'name_id'         => 'nullable|integer|exists:names,id',
			'follow_number'   => 'integer',
			'purchase_number' => 'integer',
			'control'         => 'nullable|string|date',
			'place'           => 'string',
			'latitude'        => 'string',
			'longitude'       => 'string',
			'replant'         => 'nullable|boolean',
			'moved'           => 'nullable|string|date',
			'dead'            => 'nullable|boolean',
			'planted'         => 'nullable|string|date',
			'note'            => 'nullable|string',
			'description'     => 'nullable|string',
			'image'           => 'nullable|image',
			'type_id'         => 'nullable|integer|exists:types,id',
			'sex_id'          => 'nullable|integer|exists:sexes,id',
			'specie_id'       => 'nullable|integer|exists:species,id',
			'subspecie_id'    => 'nullable|integer|exists:subspecies,id',
			'group_id'        => 'nullable|integer|exists:groups,id',
			'synonym_id'      => 'nullable|integer|exists:synonyms,id',
			'crossing_id'     => 'nullable|integer|exists:crossings,id',
			'winner_id'       => 'nullable|integer|exists:winners,id',
			'treetype_id'     => 'nullable|integer|exists:treetypes,id',
			'priority_id'     => 'nullable|integer|exists:priorities,id',
			'supplier_id'     => 'nullable|integer|exists:suppliers,id',
			'size_id'         => 'nullable|integer|exists:sizes,id',
			'bloom_colors'     => 'nullable|array',
			'months'          => 'nullable|array',
			'macule_colors'    => 'nullable|array',
		] );
	}

	private function convertImage( $image )
	{
	 	$base64Str = substr( $image, strpos( $image, ',' ) + 1 );
	 	print_r(base64_decode($base64Str));
	 	return base64_decode( $base64Str );
	}

	public function import( Request $request )
	{
		set_time_limit( 0 );
		$plants = [];

		$i = 0;
		foreach( $request->all() as $plant ) {
			$default = [
				'follow_number'   => $plant[ 'volgnr' ] != null ? $plant[ 'volgnr' ] : null,
				'purchase_number' => $plant[ 'aankoopnr' ] != null ? $plant[ 'aankoopnr' ] : null,
				'control'         => $plant[ 'controle' ] != null ? explode( ' ', $plant[ 'controle' ] )[ 0 ] : null,
				'place'           => $plant[ 'plaats' ] != null ? $plant[ 'plaats' ] : null,
				'latitude'        => $plant[ 'xcoor' ] != null ? $plant[ 'xcoor' ] : null,
				'longitude'       => $plant[ 'ycoor' ] != null ? $plant[ 'ycoor' ] : null,
				'replant'         => $plant[ 'verplanten' ] != null ? $plant[ 'verplanten' ] : null,
				'moved'           => $plant[ 'verzet' ] != null ? $plant[ 'verzet' ] : null,
				'dead'            => $plant[ 'dood' ] != null ? $plant[ 'dood' ] : null,
				'planted'         => $plant[ 'pootdatum' ] != null ? explode( ' ', $plant[ 'pootdatum' ] )[ 0 ] : null,
				'note'            => $plant[ 'opmerk 1' ].' '.$plant[ 'opmerk 2' ],
				'created_at'      => date( 'Y-m-d H:i:s' ),
				'updated_at'      => date( 'Y-m-d H:i:s' ),
			];

			$type = $plant[ 'type plant' ] != null ? \App\Type::firstOrCreate( [ 'name' => $plant[ 'type plant' ] ] )[ 'id' ] : null;
			$sex = $plant[ 'geslachtsnaam' ] != null ? \App\Sex::firstOrCreate( [ 'name' => $plant[ 'geslachtsnaam' ] ] )[ 'id' ] : null;
			$specie = $plant[ 'soortnaam' ] != null ? \App\Specie::firstOrCreate( [ 'name' => $plant[ 'soortnaam' ] ] )[ 'id' ] : null;
			$variety = $plant[ 'ssp/variëteitsnaam' ] != null ? \App\Subspecie::firstOrCreate( [ 'name' => $plant[ 'ssp/variëteitsnaam' ] ] )[ 'id' ] : null;
			$group = $plant[ 'group' ] != null ? \App\Group::firstOrCreate( [ 'name' => $plant[ 'group' ] ] )[ 'id' ] : null;
			$synonym = $plant[ 'synoniem' ] != null ? \App\Synonym::firstOrCreate( [ 'name' => $plant[ 'synoniem' ] ] )[ 'id' ] : null;
			$crossing = $plant[ 'kruizings ouders' ] != null ? \App\Crossing::firstOrCreate( [ 'name' => $plant[ 'kruizings ouders' ] ] )[ 'id' ] : null;
			$winner = $plant[ 'winner' ] != null ? \App\Winner::firstOrCreate( [ 'name' => $plant[ 'winner' ] ] )[ 'id' ] : null;
			$treetypes = [ '=' => 'Loofboom', 'x' => 'Naaldboom', 'X' => 'Naaldboom', '+' => 'Boom', 'R' => 'Rhododendron' ];
			$treetype = $plant[ 'boomtype' ] != null ? \App\Treetype::firstOrCreate( [ 'name' => $treetypes[ $plant[ 'boomtype' ] ] ] )[ 'id' ] : null;
			$priority = $plant[ 'belang' ] != null ? \App\Priority::firstOrCreate( [ 'name' => $plant[ 'belang' ] ] )[ 'id' ] : null;
			$supplier = $plant[ 'leverancier' ] != null ? \App\Supplier::firstOrCreate( [ 'name' => $plant[ 'leverancier' ] ] )[ 'id' ] : null;
			$size = $plant[ 'grootte' ] != null ? \App\Size::firstOrCreate( [ 'name' => ucfirst( $plant[ 'grootte' ] ) ] )[ 'id' ] : null;
			$name = $plant[ 'neder naam' ] != null ? \App\Name::firstOrCreate( [ 'name' => $plant[ 'neder naam' ] ] )[ 'id' ] : null;

			$ids = [
				'name_id'      => $name,
				'type_id'      => $type,
				'sex_id'       => $sex,
				'specie_id'    => $specie,
				'subspecie_id' => $variety,
				'group_id'     => $group,
				'synonym_id'   => $synonym,
				'crossing_id'  => $crossing,
				'winner_id'    => $winner,
				'treetype_id'  => $treetype,
				'priority_id'  => $priority,
				'supplier_id'  => $supplier,
				'size_id'      => $size,
			];

			$bloom_colors = [];
			if( strpos( $plant[ 'blkleur' ], '-' ) !== false ) {
				$colors = explode( '-', $plant[ 'blkleur' ] );
				foreach( $colors as $key => $value ) {
					$bloom_colors[] = ucfirst( $value );
				}
			} else {
				if( strpos( $plant[ 'blkleur' ], ' ' ) !== false ) {
					$colors = explode( ' ', $plant[ 'blkleur' ] );
					foreach( $colors as $key => $value ) {
						$bloom_colors[] = ucfirst( $value );
					}
				} else {
					if( strpos( $plant[ 'blkleur' ], '/' ) !== false ) {
						$colors = explode( '/', $plant[ 'blkleur' ] );
						foreach( $colors as $key => $value ) {
							$bloom_colors[] = ucfirst( $value );
						}
					} else {
						$bloom_colors[] = ucfirst( $plant[ 'blkleur' ] );
					}
				}
			}

			$bloom_color_ids = [];
			foreach( $bloom_colors as $key => $value ) {
				$bloom_color_ids[] = \App\Color::firstOrCreate([
					'name' => $value,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				])[ 'id' ];
			}
			/***********************************************************************/

			$macule_colors = [];
			if( strpos( $plant[ 'maculekl' ], '-' ) !== false ) {
				$colors = explode( '-', $plant[ 'maculekl' ] );
				foreach( $colors as $key => $value ) {
					$macule_colors[] = ucfirst( $value );
				}
			} else {
				if( strpos( $plant[ 'maculekl' ], ' ' ) !== false ) {
					$colors = explode( ' ', $plant[ 'maculekl' ] );
					foreach( $colors as $key => $value ) {
						$macule_colors[] = ucfirst( $value );
					}
				} else {
					if( strpos( $plant[ 'maculekl' ], '/' ) !== false ) {
						$colors = explode( '/', $plant[ 'maculekl' ] );
						foreach( $colors as $key => $value ) {
							$macule_colors[] = ucfirst( $value );
						}
					} else {
						$macule_colors[] = ucfirst( $plant[ 'maculekl' ] );
					}
				}
			}

			$macule_color_ids = [];
			foreach( $macule_colors as $key => $value ) {
				$macule_color_ids[] = \App\Color::firstOrCreate([
					'name' => $value,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				])[ 'id' ];
			}
			/******************************************************************************/

			$months = [];
			if( strpos( $plant[ 'bltijd' ], '-' ) !== false ) {
				$colors = explode( '-', $plant[ 'bltijd' ] );
				foreach( $colors as $key => $value ) {
					$months[] = ucfirst( $value );
				}
			} else {
				if( strpos( $plant[ 'bltijd' ], ' ' ) !== false ) {
					$colors = explode( ' ', $plant[ 'bltijd' ] );
					foreach( $colors as $key => $value ) {
						$months[] = ucfirst( $value );
					}
				} else {
					if( strpos( $plant[ 'bltijd' ], '/' ) !== false ) {
						$colors = explode( '/', $plant[ 'bltijd' ] );
						foreach( $colors as $key => $value ) {
							$months[] = ucfirst( $value );
						}
					} else {
						$months[] = ucfirst( $plant[ 'bltijd' ] );
					}
				}
			}

			$month_ids = [];
			foreach( $months as $key => $value ) {
				$month_ids[] = \App\Month::firstOrCreate([
					'name' => $value,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				])[ 'id' ];
			}
			/*********************************************************************/

			$create = array_merge( $default, $ids );

			$plant = Plant::create( $create );

			if( !empty( $bloom_color_ids ) ) {
				$plant->bloom_colors()->attach( $bloom_color_ids );
			}

			if( !empty( $macule_color_ids ) ) {
				$plant->macule_colors()->attach( $macule_color_ids );
			}

			if( !empty( $month_ids ) ) {
				$plant->months()->attach( $month_ids );
			}

			$i++;
		}

		return response()->json( $plants );
	}
}
