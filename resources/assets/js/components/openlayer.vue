<template>
    <div>
        <div id="map" class="map" tabindex="0" style="width: 100%; height: 100%; position: absolute" />
        <button id="zoom-out" @click.prevent="zoomOut">Zoom out</button>
        <button id="zoom-in" @click,prevent="zoomIn">Zoom in</button>
    </div>
</template>

<script>
    import Map from 'ol/map';
    import View from 'ol/view';
    import Vector from 'ol/source/vector';
    import Style from 'ol/style/style';
    import Icon from 'ol/style/icon'
    import Tile from 'ol/layer/tile';
    import OSM from 'ol/source/osm';
    import Feature from 'ol/feature';
    import Point from 'ol/geom/point';
    import Proj from 'ol/proj';
    import Control from 'ol/control';

    export default
    {
    	props: {
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
            }
        },

        data()
        {
        	return {
        		map: null,
                markerSource: new Vector(),
                markerStyle: new Style({
					image: new Icon( ({
						anchor: [0.5, 46],
						anchorXUnits: 'fraction',
						anchorYUnits: 'pixels',
						opacity: 0.75,
						src: 'https://openlayers.org/en/v4.6.4/examples/data/icon.png'
					}))
				})
            }
        },

        computed: {
    	    zoomLevel()
            {
            	return this.zoom;
            }
        },

        methods: {
        	render()
            {
				this.map = new Map({
					layers: [
						new Tile({
							source: new OSM()
						})
					],
					target: 'map',
					controls: Control.defaults({
						attributionOptions: {
							collapsible: false
						}
					}),
					view: new View({
						center: Proj.fromLonLat( [this.center.lng, this.center.lat] ),
						zoom: this.zoomLevel
					})
				});

				console.log(1);
				if( this.markers.length > 0 )
                {
					console.log(2);
                	this.markers.map( marker => {
                	    this.addMarker( marker.position );
                    });
                }
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
            }
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