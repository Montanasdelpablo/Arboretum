export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all colors
		 *
		 * @param state
		 * @param colors
		 */
		colorIndex( state, colors )
		{
			state.all = colors;
		},

		/**
		 * Edit color
		 *
		 * @param state
		 * @param color
		 */
		colorEdit( state, color )
		{
			state.edit = color;
		},

		/**
		 * Search color
		 *
		 * @param state
		 * @param color
		 */
		colorSearch( state, color )
		{
			state.search = color;
		}
	},

	actions: {
		/**
		 * Get all colors from API
		 *
		 * @param context
		 * @param pagination
		 */
		colorIndex( context, pagination )
		{
			let url = '/api/colors';
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
				.then( response => context.commit( 'colorIndex', response ) )
				.catch( error => console.error( 'colorIndex', error ) );
		},

		/**
		 * Store color in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		colorStore( context, data )
		{
			return fetch( '/api/colors', {
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
				.catch( error => console.error( 'colorStore', error ) );
		},

		/**
		 * Get information from specific color
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		colorEdit( context, id )
		{
			return fetch( `/api/colors/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'colorEdit', response ) )
				.catch( error => console.error( 'colorEdit', error ) );
		},

		/**
		 * Update color in DB
		 *
		 * @param context
		 * @param data
		 */
		colorUpdate( context, data )
		{
			return fetch( `/api/colors/${data.id}`, {
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
				.catch( error => console.error( 'colorUpdate', error ) );
		},

		/**
		 * Destroy color
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		colorDestroy( context, id )
		{
			return fetch( `/api/colors/${id}`, {
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
				.catch( error => console.error( 'colorDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param color
		 */
		colorSearch( context, color ) {
			return fetch( `/api/colors/${color}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'colorSearch', response ) )
				.catch( error => console.error( 'colorSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all colors
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		colorIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		colorEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of colors
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		colorTotal( state )
		{
			return state.all.total;
		},

		colorSearch( state )
		{
			return state.search;
		}
	}
}