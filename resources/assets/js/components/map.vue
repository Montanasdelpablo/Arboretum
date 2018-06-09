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
				userLocation: null,
            }
        },

        computed: {
    	    zoomLevel()
            {
            	return this.zoom;
            },

            id()
            {
            	return `map-${this.name}`;
            }
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

            	// Initialise map
				this.map = L.map( this.id, {
					center: [ this.center.lat, this.center.lng ],
                    zoom: this.zoomLevel
                } );

				// Add tile image provider
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}).addTo( this.map );

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
                L.marker( [ marker.position.lat, marker.position.lng ], {
                	icon: L.BeautifyIcon.icon( {
                        icon: marker.icon ? marker.icon : 'leaf',
                        iconShape: marker.shape ? marker.shape : 'marker',
                        borderWidth: 0,
                        iconStyle: `width: 50px; height: 50px; background: ${marker.background ? marker.background : '#000'}`,
                        innerIconStyle: 'color: white; margin-top: 14px; margin-left: -4px; font-size: 23px',
                    })
                })
                    .addTo( this.map );
            },

			/**
			 * Set user location
			 */
			getUserLocation()
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
							this.userLocation = position;
						},
						( error ) => {
							console.error( error.message );
							this.userLocation = this.center;
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
				this.getUserLocation();
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
            }
        }
	};
</script>