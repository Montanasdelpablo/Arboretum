<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json( User::all() );
	}

	public function login()
	{
		// validate the info, create rules for the inputs
		$rules = [
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		];

		// run the validation rules on the inputs from the form
		$validator = Validator::make( Input::all(), $rules );

		// if the validator fails, redirect back to the form
		if( $validator->fails() )
		{
			return response()->json( [ 'success' => false, 'message' => 'Not logged in', 'result' => $validator, 'input' => Input::except( 'password' ) ], 400 );
		} else
		{

			// create our user data for the authentication
			$userdata = [
				'email'    => Input::get( 'email' ),
				'password' => Input::get( 'password' ),
			];

			// attempt to do the login
			if( Auth::attempt( $userdata ) )
			{

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return response()->json( [ 'success' => true, 'message' => 'Logged in' ], 201 );
			} else
			{

				// validation not successful, send back to form
				return response()->json( [ 'success' => false, 'message' => 'Not logged in' ], 400 );
			}
		}
	}

	public function forgotpw()
	{
		$this->validatie( request(), [
			'email' => 'required|email',
		] );
		// gather password from user using email above

		// send mail to email with new/old password or link to make a new one
	}

	public function logout()
	{
		Auth::logout(); // log the user out of our application
		if( empty( $user = Auth::user() ) )
		{
			return response()->json( [ 'success' => true, 'message' => 'Logged out succesfully' ], 201 );
		} else
		{
			return response()->json( [ 'success' => false, 'message' => 'Not logged out succesfully' ], 400 );
		}
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function register( Request $request )
	{
		print_r($request->all());
		print_r($request->input('first_name'));

		$request->validate( [
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email'    => 'required|string|email',
			'password' => 'required',
		] );

		// Hash password first (Hash::make)
		//$request->merge( [ 'password' => Hash::make( $request->input( 'password' ) ) ] );

		// Create user
		$user = User::create([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'password' => $request->input('password')
		]);
		//auth()->login($user);
		//return $user;
		//if(empty($user = Auth::user())){
		//  return response()->json( [ 'success' => true, 'message' => 'Created account succesfully'], 201);
		//} else {
		//  return response()->json( [ 'success' => false, 'message' => 'Not created account'], 400);
		//  }
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request )
	{
		$this->validation( $request );

		$created = User::create( $request->all() );

		if( $created )
		{
			return response()->json( [ 'success' => true, 'message' => 'User created', 'result' => $created ], 201 );
		} else
		{
			return response()->json( [ 'success' => false, 'message' => 'User not created' ], 400 );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( User $user )
	{
		return response()->json( $user, 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( User $user )
	{
		return response()->json( $user, 200 );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\User                $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, User $user )
	{
		$this->validation( $request );

		$updated = $user->update( $request->all() );

		if( $updated )
		{
			return response()->json( [ 'success' => true, 'message' => 'User updated', 'result' => $updated ], 200 );
		} else
		{
			return response()->json( [ 'success' => false, 'message' => 'User not updated' ], 400 );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy( User $user )
	{
		$destroyed = $user->delete();

		if( $destroyed )
		{
			return response()->json( [ 'success' => true, 'message' => 'User deleted', 'result' => $user ], 200 );
		} else
		{
			return response()->json( [ 'success' => false, 'message' => 'User not deleted' ], 400 );
		}
	}

	public function search( $search )
	{
		$results = User::where( 'name', 'like', '%'.$search.'%' )
			->orWhere( 'id', $search )
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate( [
			'name' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'email' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:email',
		] );
	}
}
