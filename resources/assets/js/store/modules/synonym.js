export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all synonyms
		 *
		 * @param state
		 * @param synonyms
		 */
		synonymIndex( state, synonyms )
		{
			state.all = synonyms;
		},

		/**
		 * Edit synonym
		 *
		 * @param state
		 * @param synonym
		 */
		synonymEdit( state, synonym )
		{
			state.edit = synonym;
		},

		/**
		 * Search synonym
		 *
		 * @param state
		 * @param synonym
		 */
		synonymSearch( state, synonym )
		{
			state.search = synonym;
		}
	},

	actions: {
		/**
		 * Get all synonyms from API
		 *
		 * @param context
		 * @param pagination
		 */
		synonymIndex( context, pagination )
		{
			let url = '/api/synonyms';
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
				.then( response => context.commit( 'synonymIndex', response ) )
				.catch( error => console.error( 'synonymIndex', error ) );
		},

		/**
		 * Store synonym in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		synonymStore( context, data )
		{
			return fetch( '/api/synonyms', {
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
				.catch( error => console.error( 'synonymStore', error ) );
		},

		/**
		 * Get information from specific synonym
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		synonymEdit( context, id )
		{
			return fetch( `/api/synonyms/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'synonymEdit', response ) )
				.catch( error => console.error( 'synonymEdit', error ) );
		},

		/**
		 * Update synonym in DB
		 *
		 * @param context
		 * @param data
		 */
		synonymUpdate( context, data )
		{
			return fetch( `/api/synonyms/${data.id}`, {
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
				.catch( error => console.error( 'synonymUpdate', error ) );
		},

		/**
		 * Destroy synonym
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		synonymDestroy( context, id )
		{
			return fetch( `/api/synonyms/${id}`, {
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
				.catch( error => console.error( 'synonymDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param synonym
		 */
		synonymSearch( context, synonym ) {
			return fetch( `/api/synonyms/${synonym}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'synonymSearch', response ) )
				.catch( error => console.error( 'synonymSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all synonyms
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		synonymIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		synonymEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of synonyms
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		synonymTotal( state )
		{
			return state.all.total;
		},

		synonymSearch( state )
		{
			return state.search;
		}
	}
}