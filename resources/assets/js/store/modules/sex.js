export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all sexes
		 *
		 * @param state
		 * @param sexes
		 */
		sexIndex( state, sexes )
		{
			state.all = sexes;
		},

		/**
		 * Edit sex
		 *
		 * @param state
		 * @param sex
		 */
		sexEdit( state, sex )
		{
			state.edit = sex;
		},

		/**
		 * Search sex
		 *
		 * @param state
		 * @param sex
		 */
		sexSearch( state, sex )
		{
			state.search = sex;
		}
	},

	actions: {
		/**
		 * Get all sexes from API
		 *
		 * @param context
		 * @param pagination
		 */
		sexIndex( context, pagination )
		{
			let url = '/api/sexes';
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
				.then( response => context.commit( 'sexIndex', response ) )
				.catch( error => console.error( 'sexIndex', error ) );
		},

		/**
		 * Store sex in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		sexStore( context, data )
		{
			return fetch( '/api/sexes', {
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
				.catch( error => console.error( 'sexStore', error ) );
		},

		/**
		 * Get information from specific sex
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		sexEdit( context, id )
		{
			return fetch( `/api/sexes/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'sexEdit', response ) )
				.catch( error => console.error( 'sexEdit', error ) );
		},

		/**
		 * Update sex in DB
		 *
		 * @param context
		 * @param data
		 */
		sexUpdate( context, data )
		{
			return fetch( `/api/sexes/${data.id}`, {
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
				.catch( error => console.error( 'sexUpdate', error ) );
		},

		/**
		 * Destroy sex
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		sexDestroy( context, id )
		{
			return fetch( `/api/sexes/${id}`, {
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
				.catch( error => console.error( 'sexDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param sex
		 */
		sexSearch( context, sex ) {
			return fetch( `/api/sexes/${sex}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'sexSearch', response ) )
				.catch( error => console.error( 'sexSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all sexes
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		sexIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		sexEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of sexes
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		sexTotal( state )
		{
			return state.all.total;
		},

		sexSearch( state )
		{
			return state.search;
		}
	}
}