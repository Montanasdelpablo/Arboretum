export default {
	state: {
		all: [],
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

		login( context, data )
		{
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
					context.commit( 'userIndex', response )
				} )
				.catch( error => console.error( 'userIndex', error ) );
		},

		forgotPassword( context, data )
		{
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
					context.commit( 'userIndex', response )
				} )
				.catch( error => console.error( 'userIndex', error ) );
		},

		register( context, data )
		{
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
			let url = '/api/users';
			if( pagination && Object.keys( pagination ).length > 1 )
			{
				url += `?${Object.keys( pagination ).map( key => `${key}=${pagination[key]}` ).join( '&' ) }`;
			}

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
			return state.edit;
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
