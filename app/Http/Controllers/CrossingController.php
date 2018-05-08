<?php

namespace App\Http\Controllers;

use App\Crossing;
use Illuminate\Http\Request;

class CrossingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Crossing::all() );
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

		$created = Crossing::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing created', $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Crossing not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Crossing  $crossing
	 * @return \Illuminate\Http\Response
	 */
	public function show( Crossing $crossing )
	{
		return response()->json( $crossing, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Crossing  $crossing
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Crossing $crossing )
	{
		return response()->json( $crossing, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Crossing  $crossing
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Crossing $crossing )
	{
		$this->validation( $request );

		$updated = $crossing->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Crossing not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Crossing  $crossing
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Crossing $crossing )
	{
		$destroyed = $crossing->destroy();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing deleted', $crossing ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Crossing not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Crossing::where('name', 'like', '%'.$search.'%')
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
