<template>
    <v-container grid-list-md fluid style="margin-top:64px">
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
        </v-layout>

        <v-divider />

        <v-layout row wrap>
            <v-flex sm12 md3 v-for="plant in plantIndex" :key="plant.id">
                <v-card hover>
                    <!-- Image -->
                    <v-card-media src="https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg" height="200px"/>

                    <v-card-title>
                        <h3 class="title">
                            {{ plant.sex ? plant.sex.name : '' }}
                            {{ plant.specie ? plant.specie.name : '' }}
                            {{ plant.subspecie ? plant.subspecie.name : '' }}
                        </h3>
                    </v-card-title>

                    <v-card-text>{{ plant.description }}</v-card-text>

                    <v-card-actions>
                        <v-btn
                            flat
                            color="primary"
                           :to="{ name: 'plantShow', params: { id: plant.id }}"
                        >
                            Lees meer
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout justify-center>
            <v-flex xs12 md6>
                <v-pagination :length="pages" v-model="form.page"></v-pagination>
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
                    orderBy: 'sex.name',
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
			plantIndex()
			{
				let plants = this.$store.getters.plantIndex,
                    page = this.form.page,
                    items = this.form.rowsPerPage,
                    firstItem = ( page - 1 ) * items,
                    lastItem = firstItem + items,
                    orderBy = this.form.orderBy.split( '.' ),
                    ascending = this.form.ascending;

				// OrderBy
				plants.sort( ( a, b ) => {
					if( a[orderBy[0]] != null && b[orderBy[0]] != null )
					{

						let valueA = a[orderBy[0]][orderBy[1]].toUpperCase();
						let valueB = b[orderBy[0]][orderBy[1]].toUpperCase();

						console.log( valueA, valueB );

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
					return false;
                });

				if( !ascending )
                {
                    plants.reverse()
                }

				// Paginate
				return plants.slice( firstItem, lastItem );
			},

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