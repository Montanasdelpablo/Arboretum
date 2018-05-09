<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Color::all() );
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

        $created = Color::create( $request->all() );

        if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'Color created', $created ], 201 );
		} else {
        	return response()->json( [ 'success' => false, 'message' => 'Color not created'], 400 );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show( Color $color )
    {
        return response()->json( $color, 200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit( Color $color )
    {
        return response()->json( $color, 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Color $color )
    {
        $this->validation( $request );

        $updated = $color->update( $request->all() );

        if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'Color updated', $updated ] , 200 );
		} else {
        	return response()->json( [ 'success' => false, 'message' => 'Color not updated' ], 400 );
		}
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Color $color
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy( Color $color )
    {
        $destroyed = $color->delete();

        if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'Color deleted', $color ], 200 );
		} else {
        	return response()->json( [ 'success' => false, 'message' => 'Color not deleted' ], 400 );
		}
    }

    public function search( $search )
	{
		$results = Color::where('name', 'like', '%'.$search.'%')
			->orWhere('id', $search)
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate([
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'colors' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:colors',
		]);
	}
}
