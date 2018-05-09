export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all sizes
		 *
		 * @param state
		 * @param sizes
		 */
		sizeIndex( state, sizes )
		{
			state.all = sizes;
		},

		/**
		 * Edit size
		 *
		 * @param state
		 * @param size
		 */
		sizeEdit( state, size )
		{
			state.edit = size;
		},

		/**
		 * Search size
		 *
		 * @param state
		 * @param size
		 */
		sizeSearch( state, size )
		{
			state.search = size;
		}
	},

	actions: {
		/**
		 * Get all sizes from API
		 *
		 * @param context
		 * @param pagination
		 */
		sizeIndex( context, pagination )
		{
			let url = '/api/sizes';
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
				.then( response => context.commit( 'sizeIndex', response ) )
				.catch( error => console.error( 'sizeIndex', error ) );
		},

		/**
		 * Store size in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		sizeStore( context, data )
		{
			return fetch( '/api/sizes', {
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
				.catch( error => console.error( 'sizeStore', error ) );
		},

		/**
		 * Get information from specific size
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		sizeEdit( context, id )
		{
			return fetch( `/api/sizes/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'sizeEdit', response ) )
				.catch( error => console.error( 'sizeEdit', error ) );
		},

		/**
		 * Update size in DB
		 *
		 * @param context
		 * @param data
		 */
		sizeUpdate( context, data )
		{
			return fetch( `/api/sizes/${data.id}`, {
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
				.catch( error => console.error( 'sizeUpdate', error ) );
		},

		/**
		 * Destroy size
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		sizeDestroy( context, id )
		{
			return fetch( `/api/sizes/${id}`, {
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
				.catch( error => console.error( 'sizeDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param size
		 */
		sizeSearch( context, size ) {
			return fetch( `/api/sizes/${size}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'sizeSearch', response ) )
				.catch( error => console.error( 'sizeSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all sizes
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		sizeIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		sizeEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of sizes
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		sizeTotal( state )
		{
			return state.all.total;
		},

		sizeSearch( state )
		{
			return state.search;
		}
	}
}