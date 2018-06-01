<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SizeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Size::withCount( 'plant' )
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

		$created = Size::create([
			'name' => $request->input('name'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size created', 'result' => $created ], 201 );
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

		$updated = $size->update([
			'name' => $request->input('name'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Size not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Size $size
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Size $size )
	{
		$destroyed = $size->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Size deleted', 'result' => $size ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Size not deleted' ], 400 );
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
		$results = Size::where('name', 'like', '%'.$search.'%')
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
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'sizes' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:sizes',
		]);
	}
}
