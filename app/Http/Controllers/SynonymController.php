<?php

namespace App\Http\Controllers;

use App\Synonym;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SynonymController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Synonym::all() );
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

		$created = Synonym::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Synonym created', $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Synonym not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Synonym  $synonym
	 * @return \Illuminate\Http\Response
	 */
	public function show( Synonym $synonym )
	{
		return response()->json( $synonym, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Synonym  $synonym
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Synonym $synonym )
	{
		return response()->json( $synonym, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Synonym  $synonym
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Synonym $synonym )
	{
		$this->validation( $request );

		$updated = $synonym->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Synonym updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Synonym not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Synonym $synonym
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Synonym $synonym )
	{
		$destroyed = $synonym->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Synonym deleted', $synonym ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Synonym not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Synonym::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'synonyms' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:synonyms',
		]);
	}
}
