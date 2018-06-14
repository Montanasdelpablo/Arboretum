<template>
    <div>
        <div :id="id" style="width: 100%; height: 100%; position: absolute; z-index: 1" />
    </div>
</template>

<script>
    import L from 'leaflet/dist/leaflet';

    export default
    {
    	props: {
    		name: {
    			type: String,
                required: true,
            },
    		center: {
    			type: Object,
                required: true,
            },
            userLocation: {
            	type: Object,
                required: true,
            },
            zoom: {
    			type: Number,
                required: true,
            },
            markers: {
    			type: Array,
                required: false,
            },
        },

        data()
        {
        	return {
        		map: null,
            }
        },

        computed: {
            /**
             * Id for unique maps
             */
            id()
            {
            	return `map-${this.name}`;
            },
        },

        methods: {
        	render()
            {
            	// Make sure there is no map set else remove the map
            	if( this.map !== null )
                {
                	this.map.off();
                	this.map.remove();
                }

				this.map = L.map( this.id ).setView([ this.center.lat, this.center.lng ]);

				if( this.markers.length > 0 )
				{
					let bounds = this.markers.map( marker => {
						return [
							marker.position.lat, marker.position.lng
						]
					});

					this.map.fitBounds(bounds);
				} else {
					this.map.fitBounds([[this.center.lat, this.center.lng]]);
                }

				// Add tile image provider
				new L.TileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: "Map data &copy; <a href='http://osm.org'>OpenStreetMap</a> contributors",
                    zoom: this.zoomLevel
				}).addTo(this.map);

				// Add user to map
				this.renderUserLocation();

				if( this.markers.length > 0 )
				{
					this.markers.map( marker => {
						this.addMarker( marker );
					} );
				}
            },

			/**
             * Add a marker to the map
             *
			 * @param marker
			 */
			addMarker( marker )
            {
                if( L.BeautifyIcon )
				{
					if( !marker.window )
					{
						L.marker( [marker.position.lat, marker.position.lng], {
							icon: L.BeautifyIcon.icon( {
								icon: marker.icon ? marker.icon : 'leaf',
								iconShape: marker.shape ? marker.shape : 'marker',
								borderWidth: 0,
								iconStyle: `width: 50px; height: 50px; background: ${marker.background ? marker.background : '#000'}`,
								innerIconStyle: 'color: white; margin-top: 14px; margin-left: -4px; font-size: 23px',
							} )
						} )
							.addTo( this.map );
					} else
					{
						L.marker( [marker.position.lat, marker.position.lng], {
							icon: L.BeautifyIcon.icon( {
								icon: marker.icon ? marker.icon : 'leaf',
								iconShape: marker.shape ? marker.shape : 'marker',
								borderWidth: 0,
								iconStyle: `width: 50px; height: 50px; background: ${marker.background ? marker.background : '#000'}`,
								innerIconStyle: 'color: white; margin-top: 14px; margin-left: -4px; font-size: 23px',
							} )
						} )
							.addTo( this.map )
							.bindPopup( marker.window );
					}
				}
            },

			/**
			 * Add user to map
			 */
			renderUserLocation()
			{
				let user = {
					position: this.userLocation ? this.userLocation : this.center,
					icon: 'male',
					background: '#B71C1C',
                };

				this.addMarker( user );
			},
        },

        mounted()
        {
        	this.render();
        },

        watch: {
            markers()
            {
            	this.render();
            },
            mapCenter()
            {
            	this.render();
            },
            userLocation()
            {
            	this.render();
            }
        }
	};
</script>