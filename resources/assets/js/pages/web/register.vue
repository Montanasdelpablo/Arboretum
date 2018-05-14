<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>
            <v-container style="min-height: 0; padding-top: 150px; background-color: #ffffff" :class="{'px-0': $vuetify.breakpoint.xsOnly }">
            <v-flex xs12 sm6 offset-sm3>
                  <v-form v-model="valid">
                            <v-text-field
                              v-model="email"
                              :rules="emailRules"
                              :counter="10"
                              label="Email-adres"
                              required
                            ></v-text-field>
                            <v-text-field
                              v-model="password"
                              :rules="passwordRules"
                              label="Wachtwoord"
                              required
                              invisible
                            ></v-text-field>
                            <v-text-field
                              v-model="first_name"
                              label="Voornaam"
                            ></v-text-field>
                            <v-text-field
                              v-model="last_name"
                              label="Achternaam"
                            ></v-text-field>

                            <v-btn
                                style="float:right"
                                 :disabled="!valid"
                                 @click="register"
                               >
                                 Register
                              </v-btn>
                            </v-form>
                </v-flex>
            </v-container>
            </v-layout>
        </v-parallax>
    </v-container>
</template>

<script>
	export default
	{
		metaInfo: {
			title: 'register'
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
