<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
		if( $request->filled( 'image' ) )
		{
			$request->merge( [ 'image' => $this->convertImage( $request->input( 'image' ) ) ] );
		}

		$this->validation( $request );

		$latin = $this->latinName( $request );

		$created = Plant::create( [
			'latin_name'      => $latin ? $latin : null,
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
			'image' 		  => $request->input( 'image' ),
			'name_id'         => $request->input( 'name_id' ),
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
			'created_at'      => date( 'Y-m-d H:i:s' ),
			'updated_at'      => date( 'Y-m-d H:i:s' ),
		] );

		// Add bloom colors
		if( $request->filled( 'bloom_colors' ) ) 
		{
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->bloom_colors as $bloom_color ) {
				if( is_array( $bloom_color ) ) {
					$colors[] = $bloom_color[ 'id' ];
				} else {
					$colors = $request->bloom_colors;
				}
			}

			$created->bloom_colors()->attach( $colors );
		}

		// Add bloom date
		if( $request->filled( 'months' ) ) 
		{
			$months = [];

			/*
			 * $request->months can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->months as $month ) {
				if( is_array( $month ) ) {
					$months[] = $month[ 'id' ];
				} else {
					$months = $request->months;
				}
			}

			$created->months()->attach( $months );
		}

		// Add bloom date
		if( $request->filled( 'macule_colors' ) ) 
		{
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->macule_colors as $macule_color ) {
				if( is_array( $macule_color ) ) {
					$colors[] = $macule_color[ 'id' ];
				} else {
					$colors = $request->macule_colors;
				}
			}

			$created->macule_colors()->attach( $colors );
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
		// Convert base64 image into file
		if( $request->filled( 'image' ) )
		{
			// Delete old file
			File::delete( public_path().$plant->image );
			$request->merge( [ 'image' => $this->convertImage( $request->input( 'image' ) ) ] );
		} else {
			$request->merge( [ 'image' => $plant->image ] );
		}

		$this->validation( $request );

		$latin = $this->latinName( $request );

		$updated = $plant->update( [
			'latin_name'      => $latin ? $latin : null,
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
			'image' 		  => $request->input('image'),
			'name_id'         => $request->input( 'name_id' ),
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
			'updated_at'      => date( 'Y-m-d H:i:s' ),
		] );

		// Add bloom colors
		if( $request->filled( 'bloom_colors' ) ) 
		{
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->bloom_colors as $bloom_color ) {
				if( is_array( $bloom_color ) ) {
					$colors[] = $bloom_color[ 'id' ];
				} else {
					$colors = $request->bloom_colors;
				}
			}

			$plant->bloom_colors()->sync( $colors );
		}

		// Add bloom date
		if( $request->filled( 'months' ) ) 
		{
			$months = [];

			/*
			 * $request->months can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->months as $month ) {
				if( is_array( $month ) ) {
					$months[] = $month[ 'id' ];
				} else {
					$months = $request->months;
				}
			}

			$plant->months()->sync( $months );
		}

		// Add bloom date
		if( $request->filled( 'macule_colors' ) ) 
		{
			$colors = [];

			/*
			 * $request->bloom_color can be an array of just numbers but can also be a multidimensional array containing all relative info for a color
			 * Thus it needs to be checked if the color only is an integer or an array
			 * If the color is an array only parse the id else parse the complete array
			 */
			foreach( $request->macule_colors as $macule_color ) {
				if( is_array( $macule_color ) ) {
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
		// Delete image
		if( !empty( $plant->image ) )
		{
			File::delete( public_path().$plant->image );
		}

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
			'image'           => 'nullable',
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
			'bloom_colors'    => 'nullable|array',
			'months'          => 'nullable|array',
			'macule_colors'   => 'nullable|array',
		] );
	}

	/**
	 * Convert image from base64 to actual file
	 *
	 * @param $image
	 *
	 * @return bool|string
	 */
	public function convertImage( $image )
	{
		$pngUrl = '/images/'.md5( date( 'Y-m-d H:i:s' ) ).'.png';
		$path = public_path().$pngUrl;

		$uploaded = Image::make( file_get_contents( $image ) )->save( $path );
		return $pngUrl;
	}

	/**
	 * Return latin name
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return string
	 */
	public function latinName( Request $request )
	{
		$sex = null;
		if( !empty( $request->input( 'sex_id' ) ) )
		{
			$sex = \App\Sex::find( $request->input( 'sex_id' ) )->name;
		}

		$specie = null;
		if( !empty( $request->input( 'specie_id' ) ) )
		{
			$specie = \App\Specie::find( $request->input( 'specie_id' ) )->name;
		}

		$subspecie = null;
		if( !empty( $request->input( 'subspecie_id' ) ) )
		{
			$subspecie = \App\Subspecie::find( $request->input( 'subspecie_id' ) )->name;
		}

		// Create latin name
		return $sex.' '.$specie.' '.$subspecie;
	}

	/**
	 * Import from a json file
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function import( Request $request )
	{
		set_time_limit( 0 );
		$plants = [];
		$date = date( 'Y-m-d H:i:s' );

		$i = 0;
		foreach( $request->all() as $plant ) {
			$type = !is_null( $plant[ 'type plant' ] ) ? \App\Type::firstOrCreate( [ 'name' => $plant[ 'type plant' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$sex = !is_null( $plant[ 'geslachtsnaam' ] ) ? \App\Sex::firstOrCreate( [ 'name' => $plant[ 'geslachtsnaam' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$specie = !is_null( $plant[ 'soortnaam' ] ) ? \App\Specie::firstOrCreate( [ 'name' => $plant[ 'soortnaam' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$subspecie = !is_null( $plant[ 'ssp/variëteitsnaam' ] ) ? \App\Subspecie::firstOrCreate( [ 'name' => $plant[ 'ssp/variëteitsnaam' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$group = !is_null( $plant[ 'group' ] ) ? \App\Group::firstOrCreate( [ 'name' => $plant[ 'group' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$synonym = !is_null( $plant[ 'synoniem' ] ) ? \App\Synonym::firstOrCreate( [ 'name' => $plant[ 'synoniem' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$crossing = !is_null( $plant [ 'kruizings ouders' ] ) ? \App\Crossing::firstOrCreate( [ 'name' => $plant[ 'kruizings ouders' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$winner = !is_null( $plant[ 'winner' ] ) ? \App\Winner::firstOrCreate( [ 'name' => $plant[ 'winner' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$treetypes = [ '=' => 'Loofboom', 'x' => 'Naaldboom', 'X' => 'Naaldboom', '+' => 'Boom', 'R' => 'Rhododendron' ];
			$treetype = !is_null( $plant[ 'boomtype' ] ) ? \App\Treetype::firstOrCreate( [ 'name' => $treetypes[ $plant[ 'boomtype' ] ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$priority = !is_null( $plant[ 'belang' ] ) ? \App\Priority::firstOrCreate( [ 'name' => $plant[ 'belang' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$supplier = !is_null( $plant[ 'leverancier' ] ) ? \App\Supplier::firstOrCreate( [ 'name' => $plant[ 'leverancier' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$size = !is_null( $plant[ 'grootte' ] ) ? \App\Size::firstOrCreate( [ 'name' => ucfirst( $plant[ 'grootte' ] ), 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$name = !is_null( $plant[ 'neder naam' ] ) ? \App\Name::firstOrCreate( [ 'name' => $plant[ 'neder naam' ], 'created_at' => $date, 'updated_at' => $date ] )[ 'id' ] : null;
			$latin = $plant[ 'geslachtsnaam' ].' '.$plant[ 'soortnaam' ].' '.$plant[ 'ssp/variëteitsnaam' ];

			$default = [
				'follow_number'   => !is_null( $plant[ 'volgnr' ] ) ? $plant[ 'volgnr' ] : null,
				'purchase_number' => !is_null( $plant[ 'aankoopnr' ] ) ? $plant[ 'aankoopnr' ] : null,
				'latin_name'      => $latin ? $latin : null,
				'control'         => !is_null( $plant[ 'controle' ] ) ? explode( ' ', $plant[ 'controle' ] )[ 0 ] : null,
				'place'           => !is_null( $plant[ 'plaats' ] ) ? $plant[ 'plaats' ] : null,
				'latitude'        => !is_null( $plant[ 'xcoor' ] ) ? $plant[ 'xcoor' ] : null,
				'longitude'       => !is_null( $plant[ 'ycoor' ] ) ? $plant[ 'ycoor' ] : null,
				'replant'         => !is_null( $plant[ 'verplanten' ] ) ? $plant[ 'verplanten' ] : null,
				'moved'           => !is_null( $plant[ 'verzet' ] ) ? $plant[ 'verzet' ] : null,
				'dead'            => !is_null( $plant[ 'dood' ] ) ? $plant[ 'dood' ] : null,
				'planted'         => !is_null( $plant[ 'pootdatum' ] ) ? explode( ' ', $plant[ 'pootdatum' ] )[ 0 ] : null,
				'note'            => $plant[ 'opmerk 1' ].' '.$plant[ 'opmerk 2' ],
				'created_at'      => $date,
				'updated_at'      => $date,
			];

			$ids = [
				'name_id'      => $name,
				'type_id'      => $type,
				'sex_id'       => $sex,
				'specie_id'    => $specie,
				'subspecie_id' => $subspecie,
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
				$bloom_color_ids[] = \App\Color::firstOrCreate( [
					'name'       => $value,
					'created_at' => $date,
					'updated_at' => $date,
				] )[ 'id' ];
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
				$macule_color_ids[] = \App\Color::firstOrCreate( [
					'name'       => $value,
					'created_at' => $date,
					'updated_at' => $date,
				] )[ 'id' ];
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
				$month_ids[] = \App\Month::firstOrCreate( [
					'name'       => $value,
					'created_at' => $date,
					'updated_at' => $date,
				] )[ 'id' ];
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
