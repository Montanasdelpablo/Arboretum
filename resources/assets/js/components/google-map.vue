<template>
    <div class="google-map" :id="mapName">
        <slot />
    </div>
</template>

<script>
    export default
    {
        props: ['mapId', 'zoom', 'center', 'type'],

        data()
        {
        	return {
        		mapName: `google-map-${this.mapId}`,
                map: null
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

				this.map = new google.maps.Map(element, options);
            }
        }
    }
</script>

<style scoped>
    .google-map {
        width: 100%;
        height: 1000px;
        max-height: 100%;
    }
</style>