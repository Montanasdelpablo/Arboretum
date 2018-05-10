export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all treetypes
		 *
		 * @param state
		 * @param treetypes
		 */
		treetypeIndex( state, treetypes )
		{
			state.all = treetypes;
		},

		/**
		 * Edit treetype
		 *
		 * @param state
		 * @param treetype
		 */
		treetypeEdit( state, treetype )
		{
			state.edit = treetype;
		},

		/**
		 * Search treetype
		 *
		 * @param state
		 * @param treetype
		 */
		treetypeSearch( state, treetype )
		{
			state.search = treetype;
		}
	},

	actions: {
		/**
		 * Get all treetypes from API
		 *
		 * @param context
		 * @param pagination
		 */
		treetypeIndex( context, pagination )
		{
			let url = '/api/treetypes';
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
				.then( response => context.commit( 'treetypeIndex', response ) )
				.catch( error => console.error( 'treetypeIndex', error ) );
		},

		/**
		 * Store treetype in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		treetypeStore( context, data )
		{
			return fetch( '/api/treetypes', {
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
				.catch( error => console.error( 'treetypeStore', error ) );
		},

		/**
		 * Get information from specific treetype
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		treetypeEdit( context, id )
		{
			return fetch( `/api/treetypes/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'treetypeEdit', response ) )
				.catch( error => console.error( 'treetypeEdit', error ) );
		},

		/**
		 * Update treetype in DB
		 *
		 * @param context
		 * @param data
		 */
		treetypeUpdate( context, data )
		{
			return fetch( `/api/treetypes/${data.id}`, {
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
				.catch( error => console.error( 'treetypeUpdate', error ) );
		},

		/**
		 * Destroy treetype
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		treetypeDestroy( context, id )
		{
			return fetch( `/api/treetypes/${id}`, {
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
				.catch( error => console.error( 'treetypeDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param treetype
		 */
		treetypeSearch( context, treetype ) {
			return fetch( `/api/treetypes/${treetype}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'treetypeSearch', response ) )
				.catch( error => console.error( 'treetypeSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all treetypes
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		treetypeIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		treetypeEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of treetypes
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		treetypeTotal( state )
		{
			return state.all.total;
		},

		treetypeSearch( state )
		{
			return state.search;
		}
	}
}