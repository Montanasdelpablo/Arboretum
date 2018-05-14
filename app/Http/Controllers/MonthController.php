<?php

namespace App\Http\Controllers;

use App\Month;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MonthController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Month::all() );
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

		$created = Month::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Month created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Month not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Month  $month
	 * @return \Illuminate\Http\Response
	 */
	public function show( Month $month )
	{
		return response()->json( $month, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Month  $month
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Month $month )
	{
		return response()->json( $month, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Month  $month
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Month $month )
	{
		$this->validation( $request );

		$updated = $month->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Month updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Month not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Month $month
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Month $month )
	{
		$destroyed = $month->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Month deleted', 'result' => $month ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Month not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Month::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results, 200 );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'months' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:months',
		]);
	}
}
