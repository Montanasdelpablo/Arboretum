<?php

namespace App\Http\Controllers;

use App\Specie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecieController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Specie::all() );
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

		$created = Specie::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Specie created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Specie not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Specie  $specie
	 * @return \Illuminate\Http\Response
	 */
	public function show( Specie $specie )
	{
		return response()->json( $specie, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Specie  $specie
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Specie $specie )
	{
		return response()->json( $specie, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Specie  $specie
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Specie $specie )
	{
		$this->validation( $request );

		$updated = $specie->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Specie updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Specie not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Specie $specie
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Specie $specie )
	{
		$destroyed = $specie->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Specie deleted', 'result' => $specie ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Specie not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Specie::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results, 200 );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'species' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:species',
		]);
	}
}
