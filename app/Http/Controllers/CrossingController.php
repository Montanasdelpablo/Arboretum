<?php

namespace App\Http\Controllers;

use App\Crossing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CrossingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Crossing::withCount( 'plant' )
				->get()
		);
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

		$created = Crossing::create([
			'name' => $request->input('name'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing created', 'result' => $created ], 201 );
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

		$updated = $crossing->update([
			'name' => $request->input('name'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Crossing not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Crossing $crossing
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Crossing $crossing )
	{
		$destroyed = $crossing->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Crossing deleted', 'result' => $crossing ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Crossing not deleted' ], 400 );
		}
	}

	/**
	 * Search resource in storage
	 * @param $search
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function search( $search )
	{
		$results = Crossing::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
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
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'crossings' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:crossings',
		]);
	}
}
