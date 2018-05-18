export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all subspecies
		 *
		 * @param state
		 * @param subspecies
		 */
		subspecieIndex( state, subspecies )
		{
			state.all = subspecies;
		},

		/**
		 * Edit subspecie
		 *
		 * @param state
		 * @param subspecie
		 */
		subspecieEdit( state, subspecie )
		{
			state.edit = subspecie;
		},

		/**
		 * Search subspecie
		 *
		 * @param state
		 * @param subspecie
		 */
		subspecieSearch( state, subspecie )
		{
			state.search = subspecie;
		}
	},

	actions: {
		/**
		 * Get all subspecies from API
		 *
		 * @param context
		 * @param pagination
		 */
		subspecieIndex( context, pagination )
		{
			let url = '/api/subspecies';
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
				.then( response => context.commit( 'subspecieIndex', response ) )
				.catch( error => console.error( 'subspecieIndex', error ) );
		},

		/**
		 * Store subspecie in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		subspecieStore( context, data )
		{
			return fetch( '/api/subspecies', {
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
				.catch( error => console.error( 'subspecieStore', error ) );
		},

		/**
		 * Get information from specific subspecie
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		subspecieEdit( context, id )
		{
			return fetch( `/api/subspecies/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'subspecieEdit', response ) )
				.catch( error => console.error( 'subspecieEdit', error ) );
		},

		/**
		 * Update subspecie in DB
		 *
		 * @param context
		 * @param data
		 */
		subspecieUpdate( context, data )
		{
			return fetch( `/api/subspecies/${data.id}`, {
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
				.catch( error => console.error( 'subspecieUpdate', error ) );
		},

		/**
		 * Destroy subspecie
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		subspecieDestroy( context, id )
		{
			return fetch( `/api/subspecies/${id}`, {
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
				.catch( error => console.error( 'subspecieDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param subspecie
		 */
		subspecieSearch( context, subspecie ) {
			return fetch( `/api/subspecies/${subspecie}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'subspecieSearch', response ) )
				.catch( error => console.error( 'subspecieSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all subspecies
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		subspecieIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		subspecieEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of subspecies
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		subspecieTotal( state )
		{
			return state.all.total;
		},

		subspecieSearch( state )
		{
			return state.search;
		}
	}
}