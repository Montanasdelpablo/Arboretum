<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Size::all() );
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

		$created = Size::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size created', $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Size not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Size  $size
	 * @return \Illuminate\Http\Response
	 */
	public function show( Size $size )
	{
		return response()->json( $size, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Size  $size
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Size $size )
	{
		return response()->json( $size, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Size  $size
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Size $size )
	{
		$this->validation( $request );

		$updated = $size->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Size not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Size  $size
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Size $size )
	{
		$destroyed = $size->destroy();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size deleted', $size ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Size not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Size::where('name', 'like', '%'.$search.'%')
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
