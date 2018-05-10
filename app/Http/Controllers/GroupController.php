<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( Group::all() );
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

		$created = Group::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Group created', 'result' => $created ], 201 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Group not created'], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function show( Group $group )
	{
		return response()->json( $group, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Group $group )
	{
		return response()->json( $group, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Group $group )
	{
		$this->validation( $request );

		$updated = $group->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Group updated', 'result' => $updated ] , 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Group not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Group $group
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( Group $group )
	{
		$destroyed = $group->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Group deleted', 'result' => $group ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Group not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = Group::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'groups' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:groups',
		]);
	}
}
