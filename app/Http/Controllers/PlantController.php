<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$plants = Plant::all();
		return response()->json( $plants );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request )
	{
		$this->validation( $request );

		$created = Plant::create([
			'name' => $request->input( 'name' ),
			'follow_number' => $request->input( 'follow_number' ),
			'purchase_number' => $request->input( 'purchase_number' ),
			'control' => $request->input( 'control' ),
			'place' => $request->input( 'place' ),
			'latitude' => $request->input( 'latitude' ),
			'longitude' => $request->input( 'longitude' ),
			'replant' => $request->input( 'replant' ),
			'moved' => $request->input( 'moved' ),
			'dead' => $request->input( 'dead' ),
			'planted' => $request->input( 'planted' ),
			'note' => $request->input( 'note' ),
			'description' => $request->input( 'description' ),
			'type_id' => $request->input( 'type_id' ),
			'sex_id' => $request->input( 'sex_id' ),
			'specie_id' => $request->input( 'specie_id' ),
			'variety_id' => $request->input( 'variety_id' ),
			'group_id' => $request->input( 'group_id' ),
			'synonym_id' => $request->input( 'synonym_id' ),
			'crossing_id' => $request->input( 'crossing_id' ),
			'winner_id' => $request->input( 'winner_id' ),
			'treetype_id' => $request->input( 'treetype_id' ),
			'priority_id' => $request->input( 'priority_id' ),
			'supplier_id' => $request->input( 'supplier_id' ),
			'size_id' => $request->input( 'size_id' ),
		]);

		// Add bloom colors
		if( !empty( $request->bloom_color ) )
		{
			$created->bloom_colors()->attach( $request->bloom_color );
		}

		// Add bloom date
		if( !empty( $request->bloom_date ) )
		{
			$created->bloom_dates()->attach( $request->bloom_date );
		}

		// Add bloom date
		if( !empty( $request->macule_color ) )
		{
			$created->macule_colors()->attach( $request->macule_color );
		}

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Plant  $plant
	 * @return \Illuminate\Http\Response
	 */
	public function show( Plant $plant )
	{
		return response()->json( $plant, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Plant  $plant
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Plant $plant )
	{
		return response()->json( $plant, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Plant  $plant
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Plant $plant )
	{
		$this->validation( $request );

		$updated = $plant->update([
			'name' => $request->input( 'name' ),
			'follow_number' => $request->input( 'follow_number' ),
			'purchase_number' => $request->input( 'purchase_number' ),
			'control' => $request->input( 'control' ),
			'place' => $request->input( 'place' ),
			'latitude' => $request->input( 'latitude' ),
			'longitude' => $request->input( 'longitude' ),
			'replant' => $request->input( 'replant' ),
			'moved' => $request->input( 'moved' ),
			'dead' => $request->input( 'dead' ),
			'planted' => $request->input( 'planted' ),
			'note' => $request->input( 'note' ),
			'description' => $request->input( 'description' ),
			'type_id' => $request->input( 'type_id' ),
			'sex_id' => $request->input( 'sex_id' ),
			'specie_id' => $request->input( 'specie_id' ),
			'variety_id' => $request->input( 'variety_id' ),
			'group_id' => $request->input( 'group_id' ),
			'synonym_id' => $request->input( 'synonym_id' ),
			'crossing_id' => $request->input( 'crossing_id' ),
			'winner_id' => $request->input( 'winner_id' ),
			'treetype_id' => $request->input( 'treetype_id' ),
			'priority_id' => $request->input( 'priority_id' ),
			'supplier_id' => $request->input( 'supplier_id' ),
			'size_id' => $request->input( 'size_id' ),
		]);

		// Add bloom colors
		if( !empty( $request->bloom_color ) )
		{
			$plant->bloom_colors()->sync( $request->bloom_color );
		}

		// Add bloom date
		if( !empty( $request->bloom_date ) )
		{
			$plant->bloom_dates()->sync( $request->bloom_date );
		}

		// Add bloom date
		if( !empty( $request->macule_color ) )
		{
			$plant->macule_colors()->sync( $request->macule_color );
		}

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant updated', 'result' => $updated ] , 200 );
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

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant deleted', 'result' => $plant ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Plant::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results, 200 );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => 'nullable|string',
			'follow_number' => 'nullable|integer',
			'purchase_number' => 'nullable|integer',
			'control' => 'nullable|string|date',
			'place' => 'string',
			'latitude' => 'string',
			'longitude' => 'string',
			'replant' => 'nullable|boolean',
			'moved' => 'nullable|string|date',
			'dead' => 'boolean',
			'planted' => 'string|date',
			'note' => 'nullable|string',
			'description' => 'nullable|string',
			'type_id' => 'nullable|integer|exists:types,id',
			'sex_id' => 'nullable|integer|exists:sexes,id',
			'specie_id' => 'nullable|integer|exists:species,id',
			'variety_id' => 'nullable|integer|exists:varieties,id',
			'group_id' => 'nullable|integer|exists:groups,id',
			'synonym_id' => 'nullable|integer|exists:synonyms,id',
			'crossing_id' => 'nullable|integer|exists:crossings,id',
			'winner_id' => 'nullable|integer|exists:winners,id',
			'treetype_id' => 'nullable|integer|exists:treetypes,id',
			'priority_id' => 'nullable|integer|exists:priorities,id',
			'supplier_id' => 'nullable|integer|exists:suppliers,id',
			'size_id' => 'nullable|integer|exists:sizes,id',
			'bloom_color' => 'nullable|array',
			'bloom_date' => 'nullable|array',
			'macule_color' => 'nullable|array'
		]);
	}
}
