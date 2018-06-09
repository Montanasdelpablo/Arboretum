<template>
   <v-layout row wrap>
       <v-flex xs12>
            <v-btn flat :to="{ name: 'plantIndex' }">
                <v-icon>arrow_back</v-icon>
                Terug
            </v-btn>
       </v-flex>

       <v-flex xs12>
            <span class="headline">Belang</span>
            <v-layout row wrap>
                <v-flex v-for="priority in priorities" xs1 :key="priority.id">
                    <div :style="`width: 25px; height: 25px; background: ${priority.color}; text-align: center;`">
                        {{ priority.name }}
                    </div>
                </v-flex>
            </v-layout>

            <leaflet
                :center="{ lat: 53.360787, lng: 6.465230 }"
                :zoom="18"
                name="plants"
                style="width:100%;height:800px"
                :markers="markers"
            />
       </v-flex>
    </v-layout>
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
				priority: null,
			}
        },

    	computed: {
    		plants()
            {
            	return this.$store.getters.plantIndex;
            },

            priorities()
            {
            	return this.$store.getters.priorityIndex;
            },

			markers()
			{
				return this.plants.map( plant => {
                    return {
                        background: plant.priority ? plant.priority.color : '#78B856',
                        window: plant.id,
                        position: { lat: 53.360787, lng: 6.465230 }
                    }
				});
			}
        },

    	mounted() {
    		this.$store.dispatch( 'plantIndex' );

    		this.$store.dispatch( 'priorityIndex' );
        }
    }
</script>