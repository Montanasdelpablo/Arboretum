<template>
    <v-container grid-list-md fluid style="margin-top:64px">
        <v-layout row wrap>
            <v-flex xs12>
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
                    v-model="form.descending"
                    :items="descending"
                />
            </v-flex>

            <v-btn flat color="secondary" @click="">
                Sorteren
            </v-btn>
        </v-layout>

        <v-divider />

        <v-layout row wrap>
            <v-flex sm12 md3 v-for="plant in plantIndex" :key="plant.id">
                <v-card hover>
                    <!-- Image -->
                    <v-card-media src="https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg"
                                  height="200px"/>

                    <v-card-title>
                        <h3 class="headline">
                            {{ plant.sex.name }} {{ plant.specie.name }} ({{ plant.name }})
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
    </v-container>
</template>

<script>
	export default {
		data()
        {
        	return {
                form: {},
                rowsPerPage: [
					{
						text: 5,
						value: 5
					},
					{
						text: 10,
						value: 10
					},
					{
						text: 25,
						value: 25
					},
					{
						text: 'Alles',
						value: -1
					}
				],
                descending: [
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
                        value: 'name'
                    },
                    {
                        text: 'Bloeikleur',
                        value: 'bloom_colors'
                    },
                    {
                        text: 'Maculekleur',
                        value: 'macule_colors'
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
                    	text: 'Bloeidatum',
                        value: 'months.name'
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
                    }
                ]
            }
        },

		computed: {
			plantIndex()
			{
                return this.$store.getters.plantIndex;
			}
		},

		methods: {
		},

		mounted()
		{
			this.$store.dispatch( 'plantIndex' );
		}
	}
</script>