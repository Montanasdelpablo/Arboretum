<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>
                <v-tabs icons-and-text centered color="primary" slider-color="white" dark card>
                    <v-tab href="#accommodation" @click="changeForm('accommodation')">
                        <v-icon>hotel</v-icon>
                    </v-tab>
                    <v-tab href="#flight" @click="changeForm('flight')">
                        <v-icon>flight</v-icon>
                    </v-tab>
                    <v-tab href="#car" @click="changeForm('car')">
                        <v-icon>directions_car</v-icon>
                    </v-tab>

                    <v-tabs-items>
                        <v-tab-item id="accommodation">
                            acc
                        </v-tab-item>
                        <v-tab-item id="flight">
                            fl
                        </v-tab-item>
                        <v-tab-item id="car">
                            ca
                        </v-tab-item>
                    </v-tabs-items>
                </v-tabs>
            </v-layout>
        </v-parallax>
    </v-container>
</template>

<script>
	export default
	{
		metaInfo: {
			title: 'Home'
		},
		data()
		{
			return {
				image: 'https://images.pexels.com/photos/573552/pexels-photo-573552.jpeg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb',
				activity: 1,
			}
		},
		methods: {
			changeForm( type )
			{
				let img = '';
				switch( type )
				{
					case 'flight':
						img = 'https://images.pexels.com/photos/219014/pexels-photo-219014.jpeg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb';
						break;
					case 'accommodation':
						img = 'https://images.pexels.com/photos/573552/pexels-photo-573552.jpeg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb';
						break;
					case 'car':
						img = 'https://images.pexels.com/photos/21014/pexels-photo.jpg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb';
						break;
				}
				this.image = img;
			},
		},
	}
</script>