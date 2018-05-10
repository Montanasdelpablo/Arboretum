export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all groups
		 *
		 * @param state
		 * @param groups
		 */
		groupIndex( state, groups )
		{
			state.all = groups;
		},

		/**
		 * Edit group
		 *
		 * @param state
		 * @param group
		 */
		groupEdit( state, group )
		{
			state.edit = group;
		},

		/**
		 * Search group
		 *
		 * @param state
		 * @param group
		 */
		groupSearch( state, group )
		{
			state.search = group;
		}
	},

	actions: {
		/**
		 * Get all groups from API
		 *
		 * @param context
		 * @param pagination
		 */
		groupIndex( context, pagination )
		{
			let url = '/api/groups';
			if( pagination && Object.keys( pagination ).length > 1 )
			{
				url += `?${Object.keys( pagination ).map( key =>  `${key}=${pagination[ key ]}` ).join( '&' ) }`;
			}

			return fetch( url, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'groupIndex', response ) )
				.catch( error => console.error( 'groupIndex', error ) );
		},

		/**
		 * Store group in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		groupStore( context, data )
		{
			return fetch( '/api/groups', {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				},
				method: 'POST',
				body: JSON.stringify( data )
			})
				.then( response => response.json() )
				.then( response => {
					if( response.errors ) {
						context.commit( 'errors', response.errors );
					} else {
						context.commit( 'errors', []);
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				})
				.catch( error => console.error( 'groupStore', error ) );
		},

		/**
		 * Get information from specific group
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		groupEdit( context, id )
		{
			return fetch( `/api/groups/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'groupEdit', response ) )
				.catch( error => console.error( 'groupEdit', error ) );
		},

		/**
		 * Update group in DB
		 *
		 * @param context
		 * @param data
		 */
		groupUpdate( context, data )
		{
			return fetch( `/api/groups/${data.id}`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				},
				method: 'PUT',
				body: JSON.stringify( data )
			})
				.then( response => response.json() )
				.then( response => {
					if( response.errors ) {
						context.commit( 'errors', response.errors );
					} else {
						context.commit( 'errors', []);
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				})
				.catch( error => console.error( 'groupUpdate', error ) );
		},

		/**
		 * Destroy group
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		groupDestroy( context, id )
		{
			return fetch( `/api/groups/${id}`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				},
				method: 'DELETE',
			})
				.then( response => response.json() )
				.then( response => {
					if( response.errors ) {
						context.commit( 'errors', response.errors );
					} else {
						context.commit( 'errors', []);
					}
					context.commit( 'message', response.message );
					context.commit( 'success', response.success );
				})
				.catch( error => console.error( 'groupDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param group
		 */
		groupSearch( context, group ) {
			return fetch( `/api/groups/${group}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'groupSearch', response ) )
				.catch( error => console.error( 'groupSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all groups
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		groupIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		groupEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of groups
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		groupTotal( state )
		{
			return state.all.total;
		},

		groupSearch( state )
		{
			return state.search;
		}
	}
}