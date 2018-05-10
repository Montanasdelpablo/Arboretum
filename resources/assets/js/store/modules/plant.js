export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all plants
		 *
		 * @param state
		 * @param plants
		 */
		plantIndex( state, plants )
		{
			state.all = plants;
		},

		/**
		 * Edit plant
		 *
		 * @param state
		 * @param plant
		 */
		plantEdit( state, plant )
		{
			state.edit = plant;
		},

		/**
		 * Search plant
		 *
		 * @param state
		 * @param plant
		 */
		plantSearch( state, plant )
		{
			state.search = plant;
		}
	},

	actions: {
		/**
		 * Get all plants from API
		 *
		 * @param context
		 * @param pagination
		 */
		plantIndex( context, pagination )
		{
			let url = '/api/plants';
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
				.then( response => context.commit( 'plantIndex', response ) )
				.catch( error => console.error( 'plantIndex', error ) );
		},

		/**
		 * Store plant in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		plantStore( context, data )
		{
			return fetch( '/api/plants', {
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
				.catch( error => console.error( 'plantStore', error ) );
		},

		/**
		 * Get information from specific plant
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		plantEdit( context, id )
		{
			return fetch( `/api/plants/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'plantEdit', response ) )
				.catch( error => console.error( 'plantEdit', error ) );
		},

		/**
		 * Update plant in DB
		 *
		 * @param context
		 * @param data
		 */
		plantUpdate( context, data )
		{
			return fetch( `/api/plants/${data.id}`, {
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
				.catch( error => console.error( 'plantUpdate', error ) );
		},

		/**
		 * Destroy plant
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		plantDestroy( context, id )
		{
			return fetch( `/api/plants/${id}`, {
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
				.catch( error => console.error( 'plantDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param plant
		 */
		plantSearch( context, plant ) {
			return fetch( `/api/plants/${plant}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'plantSearch', response ) )
				.catch( error => console.error( 'plantSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all plants
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		plantIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		plantEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of plants
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		plantTotal( state )
		{
			return state.all.total;
		},

		plantSearch( state )
		{
			return state.search;
		}
	}
}