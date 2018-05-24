<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

	public function login( Request $request )
	{
		// validate the info, create rules for the inputs
		$request->validate([
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|string|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		]);

		// create our user data for the authentication
		$attempt = Auth::attempt( [
				'email' => $request->input( 'email' ),
				'password' => $request->input( 'password' )
		]);

		// If $attempt returns true
	  if($attempt){
				// Grab current user
				$user = Auth::user();
				// Build token
				$token = $user->createToken( config( 'app.name' ) )->accessToken;
				// Update model with token
				$user->update( [ 'api_token' => $token ] );
				// Return response 201 with data
		 		return response()->json( [ 'success' => true, 'token' => $token, 'message' => 'Logged in succesfully', 'user' => $user], 201);
		} else {
				// Return response 400
		  	return response()->json( [ 'success' => false, 'message' => 'Not logged in'], 400);
		}
	 }

	public function forgotpw (Request $request){
		// Still todo!

		// validate email
		$request->validatie([
			'email' => 'required|email',
		] );
		// gather password from user using email above

		// send mail to email with new/old password or link to make a new one
	}

	public function logout()
	{
		// No use of this function right now because we are just deleting session in frontend
		Auth::logout(); // log the user out of our application

		// Conditional check if there is not a current user
		if( empty( $user = Auth::user() ) )
		{
			// Return response 201 with data
			return response()->json( [ 'success' => true, 'message' => 'Logged out succesfully' ], 201 );
		} else
		{
			// Return response 400 with data
			return response()->json( [ 'success' => false, 'message' => 'Not logged out succesfully' ], 400 );
		}
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function register( Request $request )
	{
		//print_r($request->all());
		//print_r($request->input('first_name'));

		// Validate input
		$request->validate( [
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email'    => 'required|string|email|unique:users,email',
			'password' => 'required',
		] );

		// Hash password first (Hash::make)
		$request->merge( [ 'password' => Hash::make( $request->input( 'password' ) ) ] );

		// Create user
		$user = User::create([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'password' => $request->input('password')
		]);

		//return $user;
		if(empty($user = Auth::user())){
			// Return response 201 with data
			return response()->json( [ 'success' => true, 'message' => 'Created account succesfully'], 201);
		} else {
			// Return response 400 with data
		  return response()->json( [ 'success' => false, 'message' => 'Not created account'], 400);
		  }
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
		// Validate input
		$this->validation( $request );

		// Create new user
		$created = User::create( $request->all() );

		// If there is a user created
		if( $created )
		{
			// Return response 201 with data
			return response()->json( [ 'success' => true, 'message' => 'User created', 'result' => $created ], 201 );
		} else
		{
			// Return response 400 with data
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
		// Validate input
		$this->validation( $request );

		// Update with input
		$updated = $user->update( $request->all() );

		// If updated
		if( $updated )
		{
			// Return respose 200 with data
			return response()->json( [ 'success' => true, 'message' => 'User updated', 'result' => $updated ], 200 );
		} else
		{
			// Return response 400 with data
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
		$results = User::where( 'email', 'like', '%'.$search.'%' )
			->orWhere( 'id', $search )
			->get();

		return response()->json( $results );
	}

	private function validation( Request $request )
	{
		$request->validate( [
			'email' => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'email' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:users,email',
		] );
	}
}
