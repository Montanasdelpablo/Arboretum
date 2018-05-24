export default {
	state: {
		all: [],
		loggedIn: !!sessionStorage.getItem( 'token' ),
		user: JSON.parse( sessionStorage.getItem( 'user' ) ),
		search: {},
		edit: {}
	},

	mutations: {

		/**
		 * Set all users
		 *
		 * @param state
		 * @param users
		 */
		userIndex( state, users )
		{
			state.all = users;
		},

		userLogin( state )
		{
			state.loggedIn = true;
		},

		/**
		 * Edit user
		 *
		 * @param state
		 * @param user
		 */
		userEdit( state, user )
		{
			state.edit = user;
		},

		userLogout( state )
		{
			state.loggedIn = false;
			sessionStorage.removeItem( 'token' );
			sessionStorage.removeItem( 'user' );
		},


		/**
		 * Search user
		 *
		 * @param state
		 * @param user
		 */
		userSearch( state, user )
		{
			state.search = user;
		}
	},

	actions: {
		/**
		 * Get all users from API
		 *
		 * @param context
		 * @param pagination
		 */

		userLogout( state )
		{
			state.loggedIn = false;
			sessionStorage.removeItem( 'token' );
		},
		login( context, data )
		{

			// Returns request
			return fetch( '/api/login', {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
				},
				method: 'POST',
				body: JSON.stringify( data )
			} )
				.then( response => response.json() )
				.then( response =>
				{
					// do something
					// If there are any errors
					if( response.errors )
					{
						context.commit( 'errors', response.errors );
					}
					// Commit response to  state
					context.commit( 'message', response.message );
					context.commit( 'success', response.success ? response.success : false );
					if( response.token )
					{
						// Set session
						sessionStorage.setItem( 'token', response.token ); // Makes sure the user is logged in even after page refresh
						sessionStorage.setItem( 'user', JSON.stringify( response.user ) );
						context.commit( 'userLogin' );
					}
				} )
				.catch( error => console.error( 'userLogin', error ) );
		},

		forgotPassword( context, data )
		{
			// This does not work yet

			// Returns request
			return fetch( '/api/forgotPassword', {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
				},
				method: 'POST',
				body: JSON.stringify( data )
			} )
				.then( response => response.json() )
				.then( response =>
				{
					// Commit to state
					context.commit( 'userIndex', response )
				} )
				.catch( error => console.error( 'userIndex', error ) );
		},

		register( context, data )
		{
			// Returns request/response
			return fetch( '/api/register', {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
				},
				method: 'POST',
				body: JSON.stringify( data )
			} )
				.then( response => response.json() )
				.then( response =>
				{
					// Do something
				} )
				.catch( error => console.error( 'userRegister', error ) );
		},

		userIndex( context, pagination )
		{
			// Set url
			let url = '/api/users';
			// If pagination, add it to url
			if( pagination && Object.keys( pagination ).length > 1 )
			{
				url += `?${Object.keys( pagination ).map( key => `${key}=${pagination[key]}` ).join( '&' ) }`;
			}
			// Returns request/response
			return fetch( url, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				}
			} )
				.then( response => response.json() )
				.then( response => context.commit( 'userIndex', response ) )
				.catch( error => console.error( 'userIndex', error ) );
		},

		/**
		 * Store user in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		userStore( context, data )
		{
			return fetch( '/api/users', {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				},
				method: 'POST',
				body: JSON.stringify( data )
			} )
				.then( response => response.json() )
				.then( response =>
				{
					if( response.errors )
					{
						context.commit( 'errors', response.errors );
					} else
					{
						context.commit( 'errors', [] );
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				} )
				.catch( error => console.error( 'userStore', error ) );
		},

		/**
		 * Get information from specific user
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		userEdit( context, id )
		{
			// Returns request/response
			return fetch( `/api/users/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				}
			} )
				.then( response => response.json() )
				.then( response => context.commit( 'userEdit', response ) )
				.catch( error => console.error( 'userEdit', error ) );
		},

		/**
		 * Update user in DB
		 *
		 * @param context
		 * @param data
		 */
		userUpdate( context, data )
		{
			return fetch( `/api/users/${data.id}`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				},
				method: 'PUT',
				body: JSON.stringify( data )
			} )
				.then( response => response.json() )
				.then( response =>
				{
					if( response.errors )
					{
						context.commit( 'errors', response.errors );
					} else
					{
						context.commit( 'errors', [] );
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				} )
				.catch( error => console.error( 'userUpdate', error ) );
		},

		/**
		 * Destroy user
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		userDestroy( context, id )
		{
			return fetch( `/api/users/${id}`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				},
				method: 'DELETE',
			} )
				.then( response => response.json() )
				.then( response =>
				{
					if( response.errors )
					{
						context.commit( 'errors', response.errors );
					} else
					{
						context.commit( 'errors', [] );
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				} )
				.catch( error => console.error( 'userDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param user
		 */
		userSearch( context, user )
		{
			return fetch( `/api/users/${user}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem( 'token' )}`
				}
			} )
				.then( response => response.json() )
				.then( response => context.commit( 'userSearch', response ) )
				.catch( error => console.error( 'userSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all users
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		userIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else
			{
				return state.all;
			}
		},

		userEdit( state )
		{
			let user = state.edit;

			if( user )
			{
				user = {
					id: user.id,
					first_name: user.first_name,
					last_name: user.last_name,
					email: user.email,
					password: user.password,
				};
			}
			return user;
		},

		/**
		 * Get the total amount of users
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		userTotal( state )
		{
			return state.all.total;
		},

		userSearch( state )
		{
			return state.search;
		}
	}
}
