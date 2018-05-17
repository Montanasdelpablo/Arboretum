<template>
    <v-container grid-list-md style="margin-top:64px">
        <v-layout row wrap>
            <v-flex xs12>
                <v-layout row wrap>
                    <v-flex xs12>
                        <h1 class="display-4">{{ plant.name }}</h1>
                    </v-flex>

                    <v-flex xs12 md6>
                        <p>Beschrijving{{ plant.description }}</p>
                    </v-flex>

                    <v-flex xs12 md6>
                        <v-card>
                            <v-card-media src="https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg" />

                            <v-card-text>
                                <v-layout row wrap>
                                    <v-flex xs12 md6>
                                        <v-list two-line>
                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Latijnse naam</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.sex.name }} {{ plant.specie.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Bloeitijd</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.months.map( month => month.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Bloeikleur</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.bloom_colors.map( color => color.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Maculekleur</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.macule_colors.map( color => color.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                        </v-list>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default
    {
    	computed: {
    		plant()
            {
            	return this.$store.getters.plantShow;
            }
        },

        methods: {
    		plantShow()
            {
            	this.$store.dispatch( 'plantShow', this.$route.params.id );
            }
        },

        mounted()
        {
        	this.plantShow();
        }
    }
</script>