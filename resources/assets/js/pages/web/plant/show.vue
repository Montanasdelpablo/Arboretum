<template>
    <v-container grid-list-md fluid style="margin-top:64px">
        <v-layout row wrap>
            <v-flex xs12>
                <v-layout row wrap>
                    <v-flex xs12>
                        <h1 class="display-4">
                            {{ plant.sex ? plant.sex.name : '' }}
                            {{ plant.specie ? plant.specie.name : '' }}
                            {{ plant.subspecie ? plant.subspecie.name : '' }}
                        </h1>
                    </v-flex>

                    <v-flex xs12 md6>
                        <p>Beschrijving{{ plant.description }}</p>
                    </v-flex>

                    <v-flex xs12 md6>
                        <v-card>
                            <v-card-media
                                src="https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg"
                                height="200"
                            >
                                <img
                                    :src="`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${url}`"
                                    :alt="`QR-code ${plant.id}`"
                                    style="width:200px;height:200px;position:absolute;right:0"
                                >
                            </v-card-media>

                            <v-card-text>
                                <v-layout row wrap>
                                    <v-flex xs12 md6>
                                        <v-list two-line>
                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Latijnse naam</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.sex ? plant.sex.name : '' }}
                                                        {{ plant.specie ? plant.specie.name : '' }}
                                                        {{ plant.subspecie ? plant.subspecie.name : '' }}
                                                        <em v-if="plant.name">({{ plant.name.name }})</em>
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.months && plant.months.length > 0">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Bloeitijd</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.months.map( month => month.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.bloom_colors && plant.bloom_colors.length > 0">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Bloeikleur</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.bloom_colors.map( color => color.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.macule_colors && plant.macule_colors.length > 0">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Maculekleur</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.macule_colors.map( color => color.name ).join( ', ' ) }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.crossing">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Kruising</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.crossing.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.planted">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Gepoot</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.planted }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                        </v-list>
                                    </v-flex>

                                    <v-flex xs12 md6>
                                        <v-list two-line>
                                            <v-list-tile v-if="plant.supplier">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Leverancier</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.supplier.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.group">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Groep</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.group.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.place">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Locatie</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.place }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.type">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Typeplant</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.type.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.subspecie">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Verieteit</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.subspecie.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>

                                            <v-list-tile v-if="plant.size">
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Grootte</v-list-tile-title>
                                                    <v-list-tile-sub-title>{{ plant.size.name }}</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                        </v-list>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex xs12>
                        <google-map
                            :center="{lat:53.361050, lng:6.464806}"
                            :zoom="18"
                            map-id="plant"
                            type="satellite"
                            style="width:100%;height:500px"
                        >
                            <google-map-marker
                                :coords="{lat:53.361050, lng:6.464806}"
                            />
                        </google-map>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
	import GoogleMap from '@/components/google-map';
	import GoogleMapMarker from '@/components/google-map-marker';

    export default
    {
    	components: {
    	    'google-map': GoogleMap,
            'google-map-marker': GoogleMapMarker
        },

    	computed: {
    		plant()
            {
            	return this.$store.getters.plantShow;
            },

            url()
            {
    		    return `${window.location.hostname}${this.$route.path}`;
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