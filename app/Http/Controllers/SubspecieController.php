<?php

namespace App\Http\Controllers;

use App\Subspecie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubspecieController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Subspecie::withCount( 'plant' )
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

		$created = Subspecie::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Subspecie created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Subspecie not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Subspecie $subspecie
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Subspecie $subspecie )
	{
		return response()->json( $subspecie, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Subspecie $subspecie
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Subspecie $subspecie )
	{
		return response()->json( $subspecie, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Subspecie           $subspecie
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Subspecie $subspecie )
	{
		$this->validation( $request );

		$updated = $subspecie->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Subspecie updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Subspecie not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Subspecie $subspecie
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Subspecie $subspecie )
	{
		$destroyed = $subspecie->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Subspecie deleted', 'result' => $subspecie ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Subspecie not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Subspecie::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results, 200 );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'varieties' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:varieties',
		]);
	}
}
