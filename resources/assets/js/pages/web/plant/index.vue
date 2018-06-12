<template>
    <v-container grid-list-md fluid>
        <v-layout row wrap>
            <v-flex xs12 md2>
                <v-select
                    label="Planten per pagina"
                    v-model="form.rowsPerPage"
                    :items="rowsPerPage"
                />
            </v-flex>

            <v-flex xs12 md2>
                <v-select
                    label="Sorteer op"
                    v-model="form.orderBy"
                    :items="orderBy"
                />
            </v-flex>

            <v-flex xs12 md2>
                <v-select
                    label="Volgorde"
                    v-model="form.ascending"
                    :items="ascending"
                />
            </v-flex>

            <v-btn flat color="primary" :to="{ name: 'webPlantPrint' }">
                <v-icon>print</v-icon>
                Planten afdrukken
            </v-btn>
        </v-layout>

        <v-divider />

        <v-layout row wrap>
            <v-flex sm12 md3 v-if="plantIndex.length > 0" v-for="plant in plantIndex" :key="plant.id">
                <v-card hover :to="{ name: 'webPlantShow', params: { id: plant.id }}">
                    <!-- Image -->
                    <v-card-media
                        :src="plant.image ? plant.image : 'https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg'"
                        height="200px"
                        class="white--text"
                    >
                        <v-container fill-height fluid>
                            <v-layout fill-height>
                                <v-flex xs12 align-end flexbox>
                                    <span class="headline">{{ plant.latin_name }}</span>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-media>

                    <v-card-text>
                        <v-list>
                            <v-list-tile v-if="plant.name">
                                <v-list-tile-title>Nederlandse naam: {{ plant.name.name }}</v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile v-if="plant.place">
                                <v-list-tile-title>Locatie: {{ plant.place }}</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn
                            flat
                            color="secondary"
                           :to="{ name: 'webPlantShow', params: { id: plant.id }}"
                        >
                            Lees meer
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>

            <v-flex v-else xs12 md6 offset-md3>
                <v-alert type="info">
                    Er zijn geen resultaten gevonden
                </v-alert>
            </v-flex>
        </v-layout>

        <v-layout>
            <v-flex xs12>
                <div class="text-xs-center">
                    <v-pagination :length="pages" v-model="form.page" total-visible="7" />
                </div>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
	export default {
		data()
        {
        	return {
                form: {
                	rowsPerPage: 4,
                    ascending: true,
                    orderBy: 'name.name',
                    page: 1
                },
                rowsPerPage: [
					{
						text: 4,
						value: 4
					},
					{
						text: 8,
						value: 8
					},
					{
						text: 16,
						value: 16
					},
					{
						text: 32,
						value: 32
					},
                    {
                    	text: 64,
                        value: 64
                    },
                    {
                    	text: 128,
                        value: 128
                    }
				],
                ascending: [
					{
						text: 'Oplopend',
						value: true
					},
					{
						text: 'Aflopend',
						value: false
					}
				],
                orderBy: [
                    {
                    	text: 'Naam',
                        value: 'name.name'
                    },
                    {
                    	text: 'Latijnse naam',
                        value: 'latin_name'
                    },
                    {
                        text: 'Kruising ouders',
                        value: 'crossing.name'
                    },
                    {
                    	text: 'Groep',
                        value: 'group.name'
                    },
                    {
                    	text: 'Geslacht',
                        value: 'sex.name'
                    },
                    {
                    	text: 'Grootte',
                        value: 'size.name'
                    },
                    {
                    	text: 'Soort',
                        value: 'specie.name'
                    },
                    {
                    	text: 'Varieteit',
                        value: 'subspecie.name'
                    }
                ]
            }
        },

		computed: {
			/**
             * Get all plants based on the filter
             *
			 * @returns {*}
			 */
			plantIndex()
			{
				let plants = this.$store.getters.plantIndex,
                    page = this.form.page,
                    items = this.form.rowsPerPage,
                    firstItem = ( page - 1 ) * items,
                    lastItem = firstItem + items,
                    orderBy = this.form.orderBy,
                    ascending = this.form.ascending;

				if( plants.length > 0 )
				{
					// OrderBy
					plants.sort( ( a, b ) =>
					{
						if( a[orderBy] != null && b[orderBy] != null )
						{
                            if( orderBy.indexOf('.') > -1 )
                            {
                                orderBy = orderBy.split('.');
                                let valueA = a[orderBy[0]][orderBy[1]].toUpperCase();
                                let valueB = b[orderBy[0]][orderBy[1]].toUpperCase();

								if( valueA < valueB )
								{
									return -1
								}

								if( valueA > valueB )
								{
									return 1
								}

								return 0;
                            } else
							{
								let valueA = a[orderBy].toUpperCase();
								let valueB = b[orderBy].toUpperCase();

								if( valueA < valueB )
								{
									return -1
								}

								if( valueA > valueB )
								{
									return 1
								}

								return 0;
							}
						}
						return false;
					} );

					if( !ascending )
					{
						plants.reverse()
					}

					// Paginate
					return plants.slice( firstItem, lastItem );
				}
				return plants;
			},

			/**
             * Calculate the amount of pages
			 * @returns {number}
			 */
			pages()
			{
				return Math.ceil( this.$store.getters.plantIndex.length / this.form.rowsPerPage );
            }
		},

		mounted()
		{
			this.$store.dispatch( 'plantIndex' );
		}
	}
</script>