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
		// Decode password for validation
		$request->merge( [ 'password' => base64_decode( $request->input( 'password' ) ) ] );

		$request->validate([
			'email' => 'required|email|string|exists:users',
			'password' => 'required|string|min:6'
		]);

		$attempt = Auth::attempt( [
			'email' => $request->input( 'email' ),
			'password' => $request->input( 'password' )
		]);

		if( $attempt )
		{
			$user = Auth::user();
			$token = $user->createToken( config( 'app.name' ) )->accessToken;
			$user->update( [ 'api_token' => $token ] );

			return response()->json( [ 'success' => true, 'message' => 'You are logged in', 'token' => $token, 'user' => $user ], 200 );
		} else {
			return response()->json( [ 'success' => false, 'message' => 'Email and password combination not found' ], 401 );
		}
	}

	public function forgotpw( Request $request )
	{
		// Still todo!

		// validate email
		$request->validatie( [
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
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function register( Request $request )
	{
		// Decode password for validation
		$request->merge( [ 'password' => base64_decode( $request->input( 'password' ) ) ] );

		// Validate input
		$request->validate( [
			'first_name' => 'required|string',
			'last_name'  => 'required|string',
			'email'      => 'required|string|email|unique:users,email',
			'password'   => 'required|string|min:6',
		] );

		// Hash password first (Hash::make)
		$request->merge( [ 'password' => Hash::make( $request->input( 'password' ) ) ] );

		// Create user
		$user = User::create( [
			'first_name' => $request->input( 'first_name' ),
			'last_name'  => $request->input( 'last_name' ),
			'email'      => $request->input( 'email' ),
			'password'   => $request->input( 'password' ),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		] );

		//return $user;
		if( empty( $user = Auth::user() ) )
		{
			// Return response 201 with data
			return response()->json( [ 'success' => true, 'message' => 'Created account succesfully' ], 201 );
		} else
		{
			// Return response 400 with data
			return response()->json( [ 'success' => false, 'message' => 'Not created account' ], 400 );
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

		// Hash password
		$request->merge( [ 'password' => Hash::make( $request->input( 'password' ) ) ] );

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
		// Check if a password has been send
		if( !empty( $request->input('password') ) )
		{
			// Decode password for validation
			$request->merge( [ 'password' => base64_decode( $request->input( 'password' ) ) ] );

			$request->validate( [
				'first_name' => 'required|string',
				'last_name'  => 'required|string',
				'password' => 'required|string|min:6',
				'email'      => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'users' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:users,email',
			] );

			$request->merge( [ 'password' => Hash::make( $request->input( 'password' ) ) ] );

			$updated = $user->update( [
				'first_name' => $request->input( 'first_name' ),
				'last_name'  => $request->input( 'last_name' ),
				'password' => $request->input( 'password' ),
				'email'      => $request->input( 'email' ),
				'updated_at' => date('Y-m-d H:i:s')
			] );
		} else {
			$request->validate( [
				'first_name' => 'required|string',
				'last_name'  => 'required|string',
				'email'      => $request->input( 'id' ) ? [ 'required', 'string', Rule::unique( 'users' )->ignore( $request->input( 'id' ) ) ] : 'required|string|unique:users,email',
			] );

			$updated = $user->update( [
				'first_name' => $request->input( 'first_name' ),
				'last_name'  => $request->input( 'last_name' ),
				'email'      => $request->input( 'email' ),
				'updated_at' => date('Y-m-d H:i:s')
			] );
		}

		// If updated
		if( $updated )
		{
			// Return response 200 with data
			return response()->json( [ 'success' => true, 'message' => 'User updated', 'result' => $updated ], 200 );
		} else {
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

	/**
	 * Search resource in storage
	 * @param $search
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function search( $search )
	{
		$results = User::where( 'email', 'like', '%'.$search.'%' )
			->orWhere( 'first_name', 'like', '%'.$search.'%' )
			->orRhere( 'last_name', 'like', '%'.$search.'%' )
			->orWhere( 'id', $search )
			->get();

		return response()->json( $results );
	}
}
