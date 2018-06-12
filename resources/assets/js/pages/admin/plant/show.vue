<template>
    <v-container grid-list-md fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-layout row wrap>
                    <v-flex xs12>
                        <h1 class="display-4">
                            {{ plant.latin_name }}
                        </h1>
                    </v-flex>

                    <v-flex xs12 md6>
                        <v-flex xs12>
                            <v-btn color="primary" :to="{ name: 'plantIndex' }">
                                <v-icon>arrow_back</v-icon>
                                Terug
                            </v-btn>
                        </v-flex>

                        <v-flex xs12>
                            {{ plant.description }}
                        </v-flex>
                    </v-flex>

                    <v-flex xs12 md6>
                        <v-card>
                            <v-card-media
                                :src="plant.image ? plant.image : 'https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg'"
                                height="200"
                            >
                                <v-tooltip
                                    bottom
                                    style="width:200px;height:200px;position:absolute;right:0"
                                >
                                    <img
                                        slot="activator"
                                        :src="`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${url}`"
                                        :alt="`QR-code ${plant.id}`"
                                    >
                                    <span>Scan QR-code met QR-code scanner app op smartphone of tablet</span>
                                </v-tooltip>
                            </v-card-media>

                            <v-card-text>
                                <v-layout row wrap>
                                    <v-flex xs12 md6>
                                        <v-list two-line>
                                            <v-list-tile>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Latijnse naam</v-list-tile-title>
                                                    <v-list-tile-sub-title>
                                                        {{ plant.latin_name }}
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
                                                    <v-list-tile-title>Variëteit</v-list-tile-title>
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
                        <leaflet
                            name="plantShow"
                            style="height: 500px; width: 100%; position: relative"
                            :center="{ lat: 53.360787, lng: 6.465230 }"
                            :zoom="18"
                            :markers="marker"
                        />
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
	import Leaflet from '@/components/map';

	export default
	{
		components: {
			'leaflet' : Leaflet
		},

		computed: {
			/**
			 * Get all plants
			 *
			 * @returns {Document.plantShow|default.mutations.plantShow|default.actions.plantShow|default.getters.plantShow|default.methods.plantShow}
			 */
			plant()
			{
				return this.$store.getters.plantShow;
			},

			/**
			 * Generate url for QR-code
			 *
			 * @returns {string}
			 */
			url()
			{
				return `${window.location.hostname}${this.$route.path}`;
			},

			/**
			 * Generate the plant marker
			 *
			 * @returns {*}
			 */
			marker()
			{
				if( this.plant.latitude && this.plant.longitude )
				{
					return [
						{
							position: {
								lat: Number( this.plant.latitude ),
								lng: Number( this.plant.longitude )
							},
							icon: 'leaf',
							background: '#313D76',
							shape: 'marker'
						}
					];
				} else {
					return [];
				}
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