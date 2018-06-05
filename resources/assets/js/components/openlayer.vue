<template>
    <div>
        <div id="map" class="map" tabindex="0" style="width: 100%; height: 100%; position: absolute" />
        <button id="zoom-out" @click.prevent="zoomOut">Zoom out</button>
        <button id="zoom-in" @click,prevent="zoomIn">Zoom in</button>
    </div>
</template>

<script>
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
            }
        },

        data()
        {
        	return {
        		map: null,
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
				this.map = new ol.Map({
					layers: [
						new ol.layer.Tile({
							source: new ol.source.OSM()
						})
					],
					target: 'map',
					controls: ol.control.defaults({
						attributionOptions: {
							collapsible: false
						}
					}),
					view: new ol.View({
						center: ol.proj.fromLonLat( [this.center.lng, this.center.lat] ),
						zoom: this.zoomLevel
					})
				});
            },

            zoomOut()
            {
				let view = this.map.getView();
				let zoom = view.getZoom();
				view.setZoom( zoom - 1 );
            },

            zoomIn()
            {
				let view = this.map.getView();
				let zoom = view.getZoom();
				view.setZoom( zoom + 1 );
            }
        },

        mounted()
        {
        	this.render();
        },

        watch: {
    		zoom()
            {
    			this.render()
            },
        }
	};
</script>