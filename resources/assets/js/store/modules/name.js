export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all names
		 *
		 * @param state
		 * @param names
		 */
		nameIndex( state, names )
		{
			state.all = names;
		},

		/**
		 * Edit name
		 *
		 * @param state
		 * @param name
		 */
		nameEdit( state, name )
		{
			state.edit = name;
		},

		/**
		 * Search name
		 *
		 * @param state
		 * @param name
		 */
		nameSearch( state, name )
		{
			state.search = name;
		}
	},

	actions: {
		/**
		 * Get all names from API
		 *
		 * @param context
		 * @param pagination
		 */
		nameIndex( context, pagination )
		{
			let url = '/api/names';
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
				.then( response => context.commit( 'nameIndex', response ) )
				.catch( error => console.error( 'nameIndex', error ) );
		},

		/**
		 * Store name in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		nameStore( context, data )
		{
			return fetch( '/api/names', {
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
				.catch( error => console.error( 'nameStore', error ) );
		},

		/**
		 * Get information from specific name
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		nameEdit( context, id )
		{
			return fetch( `/api/names/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'nameEdit', response ) )
				.catch( error => console.error( 'nameEdit', error ) );
		},

		/**
		 * Update name in DB
		 *
		 * @param context
		 * @param data
		 */
		nameUpdate( context, data )
		{
			return fetch( `/api/names/${data.id}`, {
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
				.catch( error => console.error( 'nameUpdate', error ) );
		},

		/**
		 * Destroy name
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		nameDestroy( context, id )
		{
			return fetch( `/api/names/${id}`, {
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
				.catch( error => console.error( 'nameDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param name
		 */
		nameSearch( context, name ) {
			return fetch( `/api/names/${name}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'nameSearch', response ) )
				.catch( error => console.error( 'nameSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all names
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		nameIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		nameEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of names
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		nameTotal( state )
		{
			return state.all.total;
		},

		nameSearch( state )
		{
			return state.search;
		}
	}
}