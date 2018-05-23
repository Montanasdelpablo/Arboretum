<template>
    <div>marker </div>
</template>

<script>
    import GoogleMap from '@/components/google-map';
    export default
    {
    	data()
        {
        	return {
                marker: null
            }
        },

        methods: {
            render()
            {
            	console.log(this.GoogleMap.map);
                this.marker = new google.maps.Marker({
					position: this.coords,
					map: this.GoogleMap.map
				});
            }
        },

        mounted()
        {
        	this.render();
        }
    }
</script>