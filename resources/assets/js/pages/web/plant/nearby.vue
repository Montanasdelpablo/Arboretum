<template>
    <v-container grid-list-md fluid>
        <v-layout row wrap>
            <v-flex xs12 md3>
                <v-select
                    v-model="distance"
                    :items="distances"
                    label="Maximale afstand in meter"
                />
            </v-flex>

            <v-flex xs12>
                <leaflet
                    v-if="markers.length > 0"
                    :center="mapCenter"
                    :zoom="18"
                    name="plants"
                    style="width:100%;height:600px;position:relative"
                    :markers="markers"
                />
                <v-alert v-else :value="true" color="info">
                    Er zijn geen planten gevonden voor de afstand die u heeft aangegeven. Probeer het nog eens door de afstand te vergroten.
                </v-alert>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
	import Leaflet from '@/components/map';

	export default
	{
		components: {
			'leaflet': Leaflet
		},

		data()
		{
			return {
				distance: 10,
                distances: [10, 20, 50, 100, 200],
			}
		},

		computed: {
			plants()
			{
				let plants = this.$store.getters.plantIndex;

				// Add distance from user location to plant in meter
                plants.map( plant =>
                {
                    let distance = Math.ceil( this.distanceInKmBetweenEarthCoordinates( this.userLocation.lat, this.userLocation.lng, plant.latitude, plant.longitude ) * 1000 );
                    return Object.assign( plant, {
                        distance
                    });
                });

                console.log(plants);
                // Filter on distance
                let filtered = plants.filter( plant => {
                	console.log(plant.distance, this.distance);
                	return plant.distance <= this.distance;
                });

                console.log(filtered);

                return filtered.length > 0 ? filtered : [];
			},

            /**
             * Get all markers
             */
			markers()
			{
				return this.plants.map( plant => {
					return {
						background: '#78B856',
						position: plant.latitude.indexOf('.') > -1 ? { lat: plant.latitude, lng: plant.longitude } : { lat: 53.360787, lng: 6.465230 },
						window: `
                            <h1 class="headline">${plant.latin_name}</h1>

                            <img src="${plant.image ? plant.image : 'https://www.haagplanten.net/media/catalog/category/Rhododendron.jpg'}" alt="${plant.latin_name}" width="100%">

                            <ul style="list-style-type: none">
                                <li><strong>Locatie</strong>: ${plant.place}</li>
                                <li><strong>Url</strong>: <a href="/dashboard/plants/${plant.id}" target="_blank">${plant.latin_name}</a></li>
                            </ul>
                        `
					}
				});
			},

            /**
             * Get users current location
             */
            userLocation()
            {
            	return this.$store.getters.userLocation;
            },

            /**
             * Get map center
             */
            mapCenter()
            {
            	return this.$store.getters.mapCenter;
            }
		},

        methods: {
			/**
             * Convert degrees to Radians
             *
			 * @param degrees
			 * @returns {number}
			 */
			degreesToRadians( degrees )
            {
                return degrees * Math.PI / 180;
            },

			/**
             * Calculate distance in KM between GPS points
			 * @param lat1
			 * @param lon1
			 * @param lat2
			 * @param lon2
			 * @returns {number}
			 */
			distanceInKmBetweenEarthCoordinates( lat1, lon1, lat2, lon2 )
            {
                let earthRadiusKm = 6371;

                let dLat = this.degreesToRadians( lat2 - lat1 );
                let dLon = this.degreesToRadians( lon2 - lon1 );

                lat1 = this.degreesToRadians( lat1 );
                lat2 = this.degreesToRadians( lat2 );

                let a = Math.sin( dLat / 2 ) * Math.sin( dLat / 2 ) + Math.sin( dLon / 2 ) * Math.sin( dLon / 2 ) * Math.cos( lat1 ) * Math.cos( lat2 );
                let c = 2 * Math.atan2( Math.sqrt( a ), Math.sqrt( 1 - a ) );
                return earthRadiusKm * c;
            }
        },

		mounted() {
			// Set all required data
			this.$store.dispatch( 'userLocation' );

			this.$store.dispatch( 'plantIndex' );
		}
	}
</script>