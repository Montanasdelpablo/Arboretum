<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Supplier::all() );
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

		$created = Supplier::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier created', $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Supplier not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function show( Supplier $supplier )
	{
		return response()->json( $supplier, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Supplier $supplier )
	{
		return response()->json( $supplier, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Supplier $supplier )
	{
		$this->validation( $request );

		$updated = $supplier->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier updated', $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Supplier not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Supplier $supplier )
	{
		$destroyed = $supplier->destroy();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier deleted', $supplier ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Supplier not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Supplier::where('name', 'like', '%'.$search.'%')
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
