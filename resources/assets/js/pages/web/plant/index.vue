<template>
    <v-container grid-list-md fluid style="margin-top:64px">
        <v-layout row wrap class="text-xs-center">
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
                            {{ plant.sex.name }} {{ plant.specie.name }}
                        </h3>
                    </v-card-title>

                    <v-card-text>{{ plant.description }}</v-card-text>

                    <v-card-actions>
                        <v-btn
                            flat
                            color="primary"
                           :to="{ to: 'plantShow', params: { id: plant.id, name: plant.name }}"
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
                    	text: ''
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