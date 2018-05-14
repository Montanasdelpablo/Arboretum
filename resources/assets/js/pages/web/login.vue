<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>
                This is the login page
            </v-layout>
        </v-parallax>
    </v-container>
</template>

<script>
	export default
	{
		metaInfo: {
			title: 'login'
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
