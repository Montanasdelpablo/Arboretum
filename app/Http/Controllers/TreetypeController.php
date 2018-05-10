<?php

namespace App\Http\Controllers;

use App\Treetype;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TreetypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Treetype::all() );
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

		$created = Treetype::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Treetype created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Treetype not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Treetype  $treetype
	 * @return \Illuminate\Http\Response
	 */
	public function show( Treetype $treetype )
	{
		return response()->json( $treetype, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Treetype  $treetype
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Treetype $treetype )
	{
		return response()->json( $treetype, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Treetype  $treetype
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Treetype $treetype )
	{
		$this->validation( $request );

		$updated = $treetype->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Treetype updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Treetype not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Treetype $treetype
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Treetype $treetype )
	{
		$destroyed = $treetype->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Treetype deleted', 'result' => $treetype ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Treetype not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Treetype::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'treetypes' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:treetypes',
		]);
	}
}
