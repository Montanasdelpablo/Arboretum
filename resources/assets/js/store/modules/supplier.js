export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all suppliers
		 *
		 * @param state
		 * @param suppliers
		 */
		supplierIndex( state, suppliers )
		{
			state.all = suppliers;
		},

		/**
		 * Edit supplier
		 *
		 * @param state
		 * @param supplier
		 */
		supplierEdit( state, supplier )
		{
			state.edit = supplier;
		},

		/**
		 * Search supplier
		 *
		 * @param state
		 * @param supplier
		 */
		supplierSearch( state, supplier )
		{
			state.search = supplier;
		}
	},

	actions: {
		/**
		 * Get all suppliers from API
		 *
		 * @param context
		 * @param pagination
		 */
		supplierIndex( context, pagination )
		{
			let url = '/api/suppliers';
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
				.then( response => context.commit( 'supplierIndex', response ) )
				.catch( error => console.error( 'supplierIndex', error ) );
		},

		/**
		 * Store supplier in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		supplierStore( context, data )
		{
			return fetch( '/api/suppliers', {
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
				.catch( error => console.error( 'supplierStore', error ) );
		},

		/**
		 * Get information from specific supplier
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		supplierEdit( context, id )
		{
			return fetch( `/api/suppliers/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'supplierEdit', response ) )
				.catch( error => console.error( 'supplierEdit', error ) );
		},

		/**
		 * Update supplier in DB
		 *
		 * @param context
		 * @param data
		 */
		supplierUpdate( context, data )
		{
			return fetch( `/api/suppliers/${data.id}`, {
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
				.catch( error => console.error( 'supplierUpdate', error ) );
		},

		/**
		 * Destroy supplier
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		supplierDestroy( context, id )
		{
			return fetch( `/api/suppliers/${id}`, {
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
				.catch( error => console.error( 'supplierDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param supplier
		 */
		supplierSearch( context, supplier ) {
			return fetch( `/api/suppliers/${supplier}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'supplierSearch', response ) )
				.catch( error => console.error( 'supplierSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all suppliers
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		supplierIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		supplierEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of suppliers
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		supplierTotal( state )
		{
			return state.all.total;
		},

		supplierSearch( state )
		{
			return state.search;
		}
	}
}