<?php

namespace App\Http\Controllers;

use App\Name;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NameController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Name::withCount( 'plant' )
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

		$created = Name::create([
			'name' => $request->input('name')
		]);

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Name created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Name not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Name  $name
	 * @return \Illuminate\Http\Response
	 */
	public function show( Name $name )
	{
		return response()->json( $name, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Name  $name
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Name $name )
	{
		return response()->json( $name, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Name  $name
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Name $name )
	{
		$this->validation( $request );

		$updated = $name->update([
			'name' => $request->input('name')
		]);

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Name updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Name not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Name $name
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Name $name )
	{
		$destroyed = $name->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Name deleted', 'result' => $name ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Name not deleted' ], 400 );
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
		$results = Name::where('name', 'like', '%'.$search.'%')
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
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'priorities' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:priorities',
		]);
	}
}
