export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all varieties
		 *
		 * @param state
		 * @param varieties
		 */
		varietyIndex( state, varieties )
		{
			state.all = varieties;
		},

		/**
		 * Edit variety
		 *
		 * @param state
		 * @param variety
		 */
		varietyEdit( state, variety )
		{
			state.edit = variety;
		},

		/**
		 * Search variety
		 *
		 * @param state
		 * @param variety
		 */
		varietySearch( state, variety )
		{
			state.search = variety;
		}
	},

	actions: {
		/**
		 * Get all varieties from API
		 *
		 * @param context
		 * @param pagination
		 */
		varietyIndex( context, pagination )
		{
			let url = '/api/varieties';
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
				.then( response => context.commit( 'varietyIndex', response ) )
				.catch( error => console.error( 'varietyIndex', error ) );
		},

		/**
		 * Store variety in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		varietyStore( context, data )
		{
			return fetch( '/api/varieties', {
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
				.catch( error => console.error( 'varietyStore', error ) );
		},

		/**
		 * Get information from specific variety
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		varietyEdit( context, id )
		{
			return fetch( `/api/varieties/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'varietyEdit', response ) )
				.catch( error => console.error( 'varietyEdit', error ) );
		},

		/**
		 * Update variety in DB
		 *
		 * @param context
		 * @param data
		 */
		varietyUpdate( context, data )
		{
			return fetch( `/api/varieties/${data.id}`, {
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
				.catch( error => console.error( 'varietyUpdate', error ) );
		},

		/**
		 * Destroy variety
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		varietyDestroy( context, id )
		{
			return fetch( `/api/varieties/${id}`, {
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
				.catch( error => console.error( 'varietyDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param variety
		 */
		varietySearch( context, variety ) {
			return fetch( `/api/varieties/${variety}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'varietySearch', response ) )
				.catch( error => console.error( 'varietySearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all varieties
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		varietyIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		varietyEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of varieties
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		varietyTotal( state )
		{
			return state.all.total;
		},

		varietySearch( state )
		{
			return state.search;
		}
	}
}