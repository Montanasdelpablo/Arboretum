<template>
    <div class="google-map" :id="mapName" />
</template>

<script>
    import PlantShow from '@/pages/web/plant/show';

    export default
    {
        props: {
			mapId: {
				type: String,
				required: true
			},
			zoom: {
				type: Number,
				required: true,
			},
			center: {
				type: Object,
				required: true,
			},
			type: {
				type: String,
				required: false,
				default: 'satellite'
			},
            markers: {
				type: Array,
                required: false,
                default: []
            }
		},

        components: {
            'plant-show': PlantShow
        },

        data()
        {
        	return {
        		mapName: `google-map-${this.mapId}`,
                map: null,
                marker: [],
                location: null,
            }
        },

        mounted()
        {
        	this.render();
        },

        methods: {
    		render()
            {
				const element = document.getElementById( this.mapName );

				const options = {
					zoom: this.zoom,
					center: new google.maps.LatLng(this.center),
					mapTypeId: this.type
				};

				// Create map
				this.map = new google.maps.Map(element, options);

				// Add main path
				this.renderMainPath();

				// Add water
                this.renderWater();

				// User location
                this.renderUserLocation();

				// Add markers
				if( this.markers.length > 0 )
                {
                    this.renderMarkers();
                }
            },

			/**
             * Set user location
			 */
			userLocation()
            {
            	/*
            	 * If the browser supports geolocation
            	 * Else give an error
            	 */
				if( navigator.geolocation )
				{
					navigator.geolocation.getCurrentPosition(
						/*
						 * If there is a position show the user position
						 * Else give an error and set user position to the center of the map
						 */
						( position ) => {
                            console.log('user', position);
                            this.location = position;
                        },
                        ( error ) => {
							console.error( error.message );
							this.location = this.center;
                        }
                    );
				} else {
					console.error('Browser doesn\'t support geolocation');
				}
            },

            /**
             * Add user to map
             */
            renderUserLocation()
            {
            	this.userLocation();

				let user = new Marker({
					position: new google.maps.LatLng( this.location ),
					map: this.map,
					icon: {
						path: MAP_PIN,
						fillColor: '#F44336',
						fillOpacity: 1,
						strokeColor: '',
						strokeWeight: 0
					},
					map_icon_label: '<span class="map-icon map-icon-male"></span>'
				});
            },

            /**
             * Render all markers on map
             */
            renderMarkers()
            {
				this.markers.map( ( marker, i) => {
					// Check if a marker actually has a position
					if( marker && marker.position )
					{
						let position = new google.maps.LatLng( {
							lat: marker.position.lat,
							lng: marker.position.lng
						} );

						this.marker = new Marker( {
							position,
							map: this.map,
							icon: {
								path: MAP_PIN,
								fillColor: marker.color ? marker.color : '#2196F3',
								fillOpacity: 1,
								strokeColor: '',
								strokeWeight: 0
							},
							map_icon_label: '<span class="map-icon map-icon-florist"></span>'
						} );

						/*if(this.marker &&  marker.window )
						{
							this.marker.addEvent( 'click', () => {
								this.infoWindow( marker.window, this.marker );
							} );
						}*/
					}
				});
            },

			/**
             * Add main path to map
			 */
			renderMainPath()
			{
				const mainPathCoords = [
					{ lat:53.361431, lng:6.464670 },
					{ lat:53.361125, lng:6.464879 },
					{ lat:53.361116, lng:6.465372 },
					{ lat:53.361077, lng:6.465694 },
					{ lat:53.361077, lng:6.465694 },
					{ lat:53.360869, lng:6.465587 },
					{ lat:53.360856, lng:6.464949 },
					{ lat:53.361125, lng:6.464879 },
				];

				const mainPath = new google.maps.Polyline({
					path: mainPathCoords,
					strokeColor: '#BCAAA4',
					strokeOpacity: 1.0,
					strokeWeight: 7,
					map: this.map
				});
			},

			/**
             * Add water to map
			 */
			renderWater()
			{
				const waterCoords = [
					{ lat: 53.360680, lng: 6.465743 },
					{ lat: 53.361145, lng: 6.465158 },
					{ lat: 53.361202, lng: 6.464305 },
				];
				const water = new google.maps.Polyline({
					path: waterCoords,
					strokeColor: '#03A9F4',
					strokeOpacity: 1.0,
					strokeWeight: 3,
					map: this.map
				});
            },

            infoWindow( id, marker )
            {
				let infoWindow = new google.maps.InfoWindow({
					content: '<plant-show :id="id"/>'
				}).open( this.map, marker );
            }
        },

        watch: {
        	markers()
            {
        	    this.render();
            }
        }
    }
</script>