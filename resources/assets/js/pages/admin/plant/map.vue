<template>
    <div>
        <span class="headline">Belang</span>
        <v-layout row wrap>
            <v-flex v-for="priority in priorities" xs1 :key="priority.id">
                <div :style="`width: 25px; height: 25px; background: ${priority.color}; text-align: center;`">
                    {{ priority.name }}
                </div>
            </v-flex>
        </v-layout>

        <v-select
            label="Belang"
            v-model="priority"
            autocomplete
            :items="priorities"
            item-text="name"
            item-value="id"
            no-data="Geen belangen gevonden gevonden"
            cache-items
        />

        <google-map
            :center="{ lat: 53.361050, lng: 6.464806 }"
            :zoom="17"
            map-id="plants"
            type="satellite"
            style="width:100%;height:400px"
            :markers="markers"
        />
    </div>
</template>

<script>
    import GoogleMap from '@/components/google-map';

    export default
    {
    	components: {
    		'google-map': GoogleMap
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
					if( plant.latitude && plant.latitude.indexOf( '.' ) > -1 && plant.longitude &&
                        plant.longitude.indexOf( '.' ) > -1 && plant.priority.id === this.priority )
					{
						return {
							color: plant.priority ? plant.priority.color : '#78B856',
                            window: plant.id,
							position: {
								lat: Number( plant.latitude ),
								lng: Number( plant.longitude ),
							}
						}
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