<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PriorityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(
			Priority::withCount( 'plant' )
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

		$created = Priority::create([
			'name' => $request->input('name'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Priority created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Priority not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Priority  $priority
	 * @return \Illuminate\Http\Response
	 */
	public function show( Priority $priority )
	{
		return response()->json( $priority, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Priority  $priority
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Priority $priority )
	{
		return response()->json( $priority, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Priority  $priority
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Priority $priority )
	{
		$this->validation( $request );

		$updated = $priority->update([
			'name' => $request->input('name'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Priority updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Priority not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Priority $priority
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Priority $priority )
	{
		$destroyed = $priority->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Priority deleted', 'result' => $priority ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Priority not deleted' ], 400 );
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
		$results = Priority::where('name', 'like', '%'.$search.'%')
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
