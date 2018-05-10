export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all winners
		 *
		 * @param state
		 * @param winners
		 */
		winnerIndex( state, winners )
		{
			state.all = winners;
		},

		/**
		 * Edit winner
		 *
		 * @param state
		 * @param winner
		 */
		winnerEdit( state, winner )
		{
			state.edit = winner;
		},

		/**
		 * Search winner
		 *
		 * @param state
		 * @param winner
		 */
		winnerSearch( state, winner )
		{
			state.search = winner;
		}
	},

	actions: {
		/**
		 * Get all winners from API
		 *
		 * @param context
		 * @param pagination
		 */
		winnerIndex( context, pagination )
		{
			let url = '/api/winners';
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
				.then( response => context.commit( 'winnerIndex', response ) )
				.catch( error => console.error( 'winnerIndex', error ) );
		},

		/**
		 * Store winner in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		winnerStore( context, data )
		{
			return fetch( '/api/winners', {
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
				.catch( error => console.error( 'winnerStore', error ) );
		},

		/**
		 * Get information from specific winner
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		winnerEdit( context, id )
		{
			return fetch( `/api/winners/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'winnerEdit', response ) )
				.catch( error => console.error( 'winnerEdit', error ) );
		},

		/**
		 * Update winner in DB
		 *
		 * @param context
		 * @param data
		 */
		winnerUpdate( context, data )
		{
			return fetch( `/api/winners/${data.id}`, {
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
				.catch( error => console.error( 'winnerUpdate', error ) );
		},

		/**
		 * Destroy winner
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		winnerDestroy( context, id )
		{
			return fetch( `/api/winners/${id}`, {
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
				.catch( error => console.error( 'winnerDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param winner
		 */
		winnerSearch( context, winner ) {
			return fetch( `/api/winners/${winner}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'winnerSearch', response ) )
				.catch( error => console.error( 'winnerSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all winners
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		winnerIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		winnerEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of winners
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		winnerTotal( state )
		{
			return state.all.total;
		},

		winnerSearch( state )
		{
			return state.search;
		}
	}
}