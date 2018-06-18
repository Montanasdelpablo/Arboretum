<template>
    <div>
        <v-btn color="primary" type="button" @click="print">
            <v-icon>print</v-icon>
            Afdrukken
        </v-btn>


        <v-btn flat :to="{ name: 'plantIndex' }">
            <v-icon>arrow_back</v-icon>
            Terug
        </v-btn>

        <v-container fluid grid-list-md>
            <v-layout row wrap >
                <v-flex xs6 v-for="item in items" :key="item.id" style="display:table">
                    <v-flex xs12>{{ item.latin_name }} {{ item.place }}</v-flex>
                    <v-flex xs12 style="display:table; page-break-inside: avoid">
                        <img
                            :src="`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${url(item.id)}`"
                            :alt="`QR-code for ${item.latin_name}`"
                            style="display: block; page-break-inside: avoid; width:200px; height: 200px"
                        >
                    </v-flex>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
	export default
	{
		computed: {
			/**
			 * Get all items
			 *
			 * @returns {plantIndex|default.mutations.plantIndex|default.actions.plantIndex|default.getters.plantIndex}
			 */
			items()
			{
				return this.$store.getters.plantIndex;
			},
		},

		methods: {
			/**
			 * Print the current window
			 */
			print()
			{
				window.print();
			},

			/**
			 * Generate url for QR-code
			 *
			 * @returns {string}
			 */
			url( id )
			{
				let routes = this.flattenArray( this.allRoutes( this.$router.options.routes ) );
				let route = routes.find( r => r.name === 'webPlantShow' ).path.replace('//', '/').replace('/:id', '');
				return `${window.location.hostname}${route}/${id}`;
			},

			/**
			 * Return all routes in array
			 *
			 * @param routes
			 * @param path
			 * @returns {Array}
			 */
			allRoutes( routes, path = '' )
			{
				let router = [];
				routes.map( route => {
					router.push({
						name: route.name,
						path: path + route.path,
					});

					if( route.children )
					{
						router.push(
							this.allRoutes( route.children, route.path + ( path.slice( -1 ) === '/' ? '' : '/' ) )
						);
					}
				});

				return router;
			},

			/**
			 * Flatten multidimensional array
			 * @param array
			 * @returns {*}
			 */
			flattenArray( array )
			{
				return array.reduce( ( acc, val) =>
					Array.isArray( val ) ?
						acc.concat( this.flattenArray( val ) )
						:
						acc.concat( val ), [] );
			}
		},

		mounted()
		{
			this.$store.dispatch( 'plantIndex' );
		}
	}
</script>