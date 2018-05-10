export default
{
	state: {
		all: [],
		search: {},
		edit: {}
	},

	mutations:  {
		/**
		 * Set all species
		 *
		 * @param state
		 * @param species
		 */
		specieIndex( state, species )
		{
			state.all = species;
		},

		/**
		 * Edit specie
		 *
		 * @param state
		 * @param specie
		 */
		specieEdit( state, specie )
		{
			state.edit = specie;
		},

		/**
		 * Search specie
		 *
		 * @param state
		 * @param specie
		 */
		specieSearch( state, specie )
		{
			state.search = specie;
		}
	},

	actions: {
		/**
		 * Get all species from API
		 *
		 * @param context
		 * @param pagination
		 */
		specieIndex( context, pagination )
		{
			let url = '/api/species';
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
				.then( response => context.commit( 'specieIndex', response ) )
				.catch( error => console.error( 'specieIndex', error ) );
		},

		/**
		 * Store specie in DB
		 *
		 * @param context
		 * @param data
		 * @returns {Promise<any>}
		 */
		specieStore( context, data )
		{
			return fetch( '/api/species', {
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
				.catch( error => console.error( 'specieStore', error ) );
		},

		/**
		 * Get information from specific specie
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		specieEdit( context, id )
		{
			return fetch( `/api/species/${id}/edit`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response => response.json() )
				.then( response => context.commit( 'specieEdit', response ) )
				.catch( error => console.error( 'specieEdit', error ) );
		},

		/**
		 * Update specie in DB
		 *
		 * @param context
		 * @param data
		 */
		specieUpdate( context, data )
		{
			return fetch( `/api/species/${data.id}`, {
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
				.catch( error => console.error( 'specieUpdate', error ) );
		},

		/**
		 * Destroy specie
		 *
		 * @param context
		 * @param id
		 * @returns {Promise<any>}
		 */
		specieDestroy( context, id )
		{
			return fetch( `/api/species/${id}`, {
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
				.catch( error => console.error( 'specieDestroy', error ) );
		},

		/**
		 * Get search results from API
		 *
		 * @param context
		 * @param specie
		 */
		specieSearch( context, specie ) {
			return fetch( `/api/species/${specie}/search`, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-token': window.token,
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'Authorization': `Bearer ${sessionStorage.getItem('token')}`
				}
			})
				.then( response =>  response.json() )
				.then( response => context.commit( 'specieSearch', response ) )
				.catch( error => console.error( 'specieSearch', error ) );
		}
	},

	getters: {
		/**
		 * Get all species
		 *
		 * @param state
		 * @returns {{}|state.all|*}
		 */
		specieIndex( state )
		{
			if( state.all.data )
			{
				return state.all.data;
			} else {
				return state.all;
			}
		},

		specieEdit( state )
		{
			return state.edit;
		},

		/**
		 * Get the total amount of species
		 * @param state
		 * @returns {*|number|PaymentItem}
		 */
		specieTotal( state )
		{
			return state.all.total;
		},

		specieSearch( state )
		{
			return state.search;
		}
	}
}