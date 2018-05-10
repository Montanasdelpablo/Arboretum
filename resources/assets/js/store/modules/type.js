export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all types
		 *
		 * @param state
		 * @param types
		 */
		typeIndex( state, types )
		{
			state.all = types;
		},

		/**
		 * Edit type
		 *
		 * @param state
		 * @param type
		 */
		typeEdit( state, type )
		{
			state.edit = type;
		},

		/**
		 * Search type
		 *
		 * @param state
		 * @param type
		 */
		typeSearch( state, type )
		{
			state.search = type;
		}
	},

	actions: {
		/**
		 * Get all types from API
		 *
		 * @param context
		 * @param pagination
		 */
		typeIndex( context, pagination )
		{
			let url = '/api/types';
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
				.then( response => context.commit( 'typeIndex', response ) )
				.catch( error => console.error( 'typeIndex', error ) );
		},

		/**
		 * Store type in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		typeStore( context, data )
		{
			return fetch( '/api/types', {
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
				.catch( error => console.error( 'typeStore', error ) );
		},

		/**
		 * Get information from specific type
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		typeEdit( context, id )
		{
			return fetch( `/api/types/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'typeEdit', response ) )
				.catch( error => console.error( 'typeEdit', error ) );
		},

		/**
		 * Update type in DB
		 *
		 * @param context
		 * @param data
		 */
		typeUpdate( context, data )
		{
			return fetch( `/api/types/${data.id}`, {
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
				.catch( error => console.error( 'typeUpdate', error ) );
		},

		/**
		 * Destroy type
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		typeDestroy( context, id )
		{
			return fetch( `/api/types/${id}`, {
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
				.catch( error => console.error( 'typeDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param type
		 */
		typeSearch( context, type ) {
			return fetch( `/api/types/${type}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'typeSearch', response ) )
				.catch( error => console.error( 'typeSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all types
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		typeIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		typeEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of types
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		typeTotal( state )
		{
			return state.all.total;
		},

		typeSearch( state )
		{
			return state.search;
		}
	}
}