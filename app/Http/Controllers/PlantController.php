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
		return response()->json( Plant::all() );
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

		$created = Plant::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant created', $created ], 201 );
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

		$updated = $plant->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Plant  $plant
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Plant $plant )
	{
		$destroyed = $plant->destroy();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Plant deleted', $plant ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Plant not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Plant::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => 'required'
		]);
	}
}
