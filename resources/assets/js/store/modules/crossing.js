export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all crossings
		 *
		 * @param state
		 * @param crossings
		 */
		crossingIndex( state, crossings )
		{
			state.all = crossings;
		},

		/**
		 * Edit crossing
		 *
		 * @param state
		 * @param crossing
		 */
		crossingEdit( state, crossing )
		{
			state.edit = crossing;
		},

		/**
		 * Search crossing
		 *
		 * @param state
		 * @param crossing
		 */
		crossingSearch( state, crossing )
		{
			state.search = crossing;
		}
	},

	actions: {
		/**
		 * Get all crossings from API
		 *
		 * @param context
		 * @param pagination
		 */
		crossingIndex( context, pagination )
		{
			let url = '/api/crossings';
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
				.then( response => context.commit( 'crossingIndex', response ) )
				.catch( error => console.error( 'crossingIndex', error ) );
		},

		/**
		 * Store crossing in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		crossingStore( context, data )
		{
			return fetch( '/api/crossings', {
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
				.catch( error => console.error( 'crossingStore', error ) );
		},

		/**
		 * Get information from specific crossing
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		crossingEdit( context, id )
		{
			return fetch( `/api/crossings/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'crossingEdit', response ) )
				.catch( error => console.error( 'crossingEdit', error ) );
		},

		/**
		 * Update crossing in DB
		 *
		 * @param context
		 * @param data
		 */
		crossingUpdate( context, data )
		{
			return fetch( `/api/crossings/${data.id}`, {
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
				.catch( error => console.error( 'crossingUpdate', error ) );
		},

		/**
		 * Destroy crossing
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		crossingDestroy( context, id )
		{
			return fetch( `/api/crossings/${id}`, {
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
				.catch( error => console.error( 'crossingDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param crossing
		 */
		crossingSearch( context, crossing ) {
			return fetch( `/api/crossings/${crossing}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'crossingSearch', response ) )
				.catch( error => console.error( 'crossingSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all crossings
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		crossingIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		crossingEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of crossings
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		crossingTotal( state )
		{
			return state.all.total;
		},

		crossingSearch( state )
		{
			return state.search;
		}
	}
}