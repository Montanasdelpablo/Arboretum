<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Supplier::withCount( 'plant' )
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

		$created = Supplier::create([
			'name' => $request->input('name'),
			'street' => $request->input('street'),
			'number' => $request->input('number'),
			'addition' => $request->input('addition'),
			'zip_code' => $request->input('zip_code'),
			'city' => $request->input('city'),
			'phone_number' => $request->input('phone_number'),
			'website' => $request->input('website'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier created', 'result' => $created ], 201 );
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

		$updated = $supplier->update([
			'name' => $request->input('name'),
			'street' => $request->input('street'),
			'number' => $request->input('number'),
			'addition' => $request->input('addition'),
			'zip_code' => $request->input('zip_code'),
			'city' => $request->input('city'),
			'phone_number' => $request->input('phone_number'),
			'website' => $request->input('website'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Supplier not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Supplier $supplier
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Supplier $supplier )
	{
		$destroyed = $supplier->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Supplier deleted', 'result' => $supplier ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Supplier not deleted' ], 400 );
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
		$results = Supplier::where('name', 'like', '%'.$search.'%')
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
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'suppliers' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:suppliers',
			'street' => 'nullable|string',
			'number' => 'nullable|integer',
			'addition' => 'nullable|string',
			'zip_code' => 'nullable|string',
			'city' => 'nullable|string',
			'phone_number' => 'nullable|integer',
			'website'=> 'nullable|string|url'
		]);
	}
}
