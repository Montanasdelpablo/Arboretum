<template>
    <div class="google-map" :id="mapName" />
</template>

<script>
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

        data()
        {
        	return {
        		mapName: `google-map-${this.mapId}`,
                map: null,
                marker: [],
            }
        },

        mounted()
        {
        	this.render();
        },

        methods: {
    		render()
            {
				const element = document.getElementById(this.mapName);

				const options = {
					zoom: this.zoom,
					center: new google.maps.LatLng(this.center),
					mapTypeId: this.type
				};

				// Create map
				this.map = new google.maps.Map(element, options);

				// Add markers
				if( this.markers.length > 0 )
                {
                	this.markers.map( marker => {
                		let position = new google.maps.LatLng({
                			lat: marker.position.lat,
                            lng: marker.position.lng
						});

						this.marker = new Marker({
							position,
							map: this.map,
                            icon: {
								path: MAP_PIN,
								fillColor: '#2196F3',
								fillOpacity: 1,
								strokeColor: '',
								strokeWeight: 0
							},
							map_icon_label: '<span class="map-icon map-icon-florist"></span>'
						});
                    });
                }

                // Add main path
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
            }
        }
    }
</script>

<style module>
    .google-map {
        width: 100%;
        height: 1000px;
        max-height: 100%;
    }

    .map-icon, .map-icon-label {
        font-size: 24px;
        color: #fff;
        line-height: 48px;
        text-align: center;
        white-space: nowrap;
    }
</style>