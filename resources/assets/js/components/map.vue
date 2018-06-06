<template>
    <div>
        <div :id="id" class="map" tabindex="0" style="width: 100%; height: 100%; position: absolute" />
        <button id="zoom-out" @click.prevent="zoomOut">Zoom out</button>
        <button id="zoom-in" @click,prevent="zoomIn">Zoom in</button>
    </div>
</template>

<script>
    import L from 'leaflet';

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
				this.map = L.map( this.id, {
					center: [this.center.lat, this.center.lng]
                })
            },

            /**
             * Zoom out
             */
            zoomOut()
            {
				let view = this.map.getView();
				let zoom = view.getZoom();
				view.setZoom( zoom - 1 );
            },

			/**
             * Zoom in
			 */
			zoomIn()
			{
				let view = this.map.getView();
				let zoom = view.getZoom();
				view.setZoom( zoom + 1 );
            },

			/**
             * Add a marker to the map
             *
			 * @param coords
			 */
			addMarker( coords )
            {
            	console.log('add');
				let iconFeature = new Feature({
					geometry: new Point(
						Proj.fromLonLat( coords.lng, coords.lat )
                    ),
				});

				this.markerSource.addFeature(iconFeature);
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
			},
        },

        mounted()
        {
        	this.render();
        },

        watch: {
            markers()
            {
            	//this.render();
            }
        }
	};
</script>