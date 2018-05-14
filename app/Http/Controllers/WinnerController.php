<?php

namespace App\Http\Controllers;

use App\Winner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WinnerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Winner::all() );
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

		$created = Winner::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Winner created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Winner not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Winner  $winner
	 * @return \Illuminate\Http\Response
	 */
	public function show( Winner $winner )
	{
		return response()->json( $winner, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Winner  $winner
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Winner $winner )
	{
		return response()->json( $winner, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Winner  $winner
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Winner $winner )
	{
		$this->validation( $request );

		$updated = $winner->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Winner updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Winner not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Winner $winner
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Winner $winner )
	{
		$destroyed = $winner->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Winner deleted', 'result' => $winner ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Winner not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Winner::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results, 200 );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'winners' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:winners',
		]);
	}
}
