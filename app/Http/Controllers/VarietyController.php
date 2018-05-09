<?php

namespace App\Http\Controllers;

use App\Variety;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VarietyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Variety::all() );
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

		$created = Variety::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Variety created', $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Variety not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Variety  $variety
	 * @return \Illuminate\Http\Response
	 */
	public function show( Variety $variety )
	{
		return response()->json( $variety, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Variety  $variety
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Variety $variety )
	{
		return response()->json( $variety, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Variety  $variety
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Variety $variety )
	{
		$this->validation( $request );

		$updated = $variety->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Variety updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Variety not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Variety $variety
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Variety $variety )
	{
		$destroyed = $variety->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Variety deleted', $variety ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Variety not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Variety::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'varieties' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:varieties',
		]);
	}
}
