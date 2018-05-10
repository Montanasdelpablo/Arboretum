export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all priorities
		 *
		 * @param state
		 * @param priorities
		 */
		priorityIndex( state, priorities )
		{
			state.all = priorities;
		},

		/**
		 * Edit priority
		 *
		 * @param state
		 * @param priority
		 */
		priorityEdit( state, priority )
		{
			state.edit = priority;
		},

		/**
		 * Search priority
		 *
		 * @param state
		 * @param priority
		 */
		prioritySearch( state, priority )
		{
			state.search = priority;
		}
	},

	actions: {
		/**
		 * Get all priorities from API
		 *
		 * @param context
		 * @param pagination
		 */
		priorityIndex( context, pagination )
		{
			let url = '/api/priorities';
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
				.then( response => context.commit( 'priorityIndex', response ) )
				.catch( error => console.error( 'priorityIndex', error ) );
		},

		/**
		 * Store priority in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		priorityStore( context, data )
		{
			return fetch( '/api/priorities', {
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
				.catch( error => console.error( 'priorityStore', error ) );
		},

		/**
		 * Get information from specific priority
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		priorityEdit( context, id )
		{
			return fetch( `/api/priorities/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'priorityEdit', response ) )
				.catch( error => console.error( 'priorityEdit', error ) );
		},

		/**
		 * Update priority in DB
		 *
		 * @param context
		 * @param data
		 */
		priorityUpdate( context, data )
		{
			return fetch( `/api/priorities/${data.id}`, {
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
				.catch( error => console.error( 'priorityUpdate', error ) );
		},

		/**
		 * Destroy priority
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		priorityDestroy( context, id )
		{
			return fetch( `/api/priorities/${id}`, {
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
				.catch( error => console.error( 'priorityDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param priority
		 */
		prioritySearch( context, priority ) {
			return fetch( `/api/priorities/${priority}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'prioritySearch', response ) )
				.catch( error => console.error( 'prioritySearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all priorities
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		priorityIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		priorityEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of priorities
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		priorityTotal( state )
		{
			return state.all.total;
		},

		prioritySearch( state )
		{
			return state.search;
		}
	}
}