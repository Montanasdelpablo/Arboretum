export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all months
		 *
		 * @param state
		 * @param months
		 */
		monthIndex( state, months )
		{
			state.all = months;
		},

		/**
		 * Edit month
		 *
		 * @param state
		 * @param month
		 */
		monthEdit( state, month )
		{
			state.edit = month;
		},

		/**
		 * Search month
		 *
		 * @param state
		 * @param month
		 */
		monthSearch( state, month )
		{
			state.search = month;
		}
	},

	actions: {
		/**
		 * Get all months from API
		 *
		 * @param context
		 * @param pagination
		 */
		monthIndex( context, pagination )
		{
			let url = '/api/months';
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
				.then( response => context.commit( 'monthIndex', response ) )
				.catch( error => console.error( 'monthIndex', error ) );
		},

		/**
		 * Store month in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		monthStore( context, data )
		{
			return fetch( '/api/months', {
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
				.catch( error => console.error( 'monthStore', error ) );
		},

		/**
		 * Get information from specific month
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		monthEdit( context, id )
		{
			return fetch( `/api/months/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'monthEdit', response ) )
				.catch( error => console.error( 'monthEdit', error ) );
		},

		/**
		 * Update month in DB
		 *
		 * @param context
		 * @param data
		 */
		monthUpdate( context, data )
		{
			return fetch( `/api/months/${data.id}`, {
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
				.catch( error => console.error( 'monthUpdate', error ) );
		},

		/**
		 * Destroy month
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		monthDestroy( context, id )
		{
			return fetch( `/api/months/${id}`, {
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
				.catch( error => console.error( 'monthDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param month
		 */
		monthSearch( context, month ) {
			return fetch( `/api/months/${month}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'monthSearch', response ) )
				.catch( error => console.error( 'monthSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all months
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		monthIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		monthEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of months
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		monthTotal( state )
		{
			return state.all.total;
		},

		monthSearch( state )
		{
			return state.search;
		}
	}
}