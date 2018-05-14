<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>

            <v-card>
                <v-card-media src="" height="200px">
                </v-card-media>
                <v-card-title primary-title>
                  <div>
                  <v-form v-model="valid">
                            <v-text-field
                              v-model="email"
                              :rules="emailRules"
                              :counter="10"
                              label="Email"
                              required
                            ></v-text-field>
                            <v-text-field
                              v-model="password"
                              :rules="passwordRules"
                              label="Password"
                              required
                              invisible
                            ></v-text-field>

                            <v-btn
                                 :disabled="!valid"
                                 @click="submit"
                               >
                                 submit
                              </v-btn>
                            </v-form>
                  </div>
                </v-card-title>

            </v-card>



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
        valid: false,
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        password: '',
        passwordRules: [
          v => !!v || 'Password is required',
          v => v.length >= 3 || 'Password must be more than 3 characters'
        ],
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
