<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>
            <v-container style="min-height: 0; padding-top: 150px; background-color: #ffffff" :class="{'px-0': $vuetify.breakpoint.xsOnly }">
            <v-flex xs12 sm6 offset-sm3>
                  <v-form v-model="valid">
                            <v-text-field
                              v-model="form.email"
                              :rules="emailRules"
                              :counter="10"
                              label="Email-adres"
                              required
                            ></v-text-field>
                            <v-text-field
                              v-model="form.password"
                              :rules="passwordRules"
                              label="Wachtwoord"
                              :type="'password'"
                              required                              
                            ></v-text-field>
                            <v-text-field
                              v-model="form.firstname"
                              label="Voornaam"
                            ></v-text-field>
                            <v-text-field
                              v-model="form.lastname"
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
			title: 'register',

		},
		data() {
        return {
  				image: 'https://images.pexels.com/photos/573552/pexels-photo-573552.jpeg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb',
  				activity: 1,
          valid: false,
          form: {
            email: '',
            password: '',
            firstname: '',
            lastname: '',
          },
          emailRules: [
            v => !!v || 'E-mail is required',
            v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
          ],
          passwordRules: [
            v => !!v || 'Password is required',
            v => v.length >= 3 || 'Password must be more than 3 characters'
          ]
		    }
    },
		methods: {
        register(){
          let user = this.form
          this.$store.dispatch( 'register', user ).then( () =>
          {
            this.data(); // Refresh data
          });
        },
		},
	}
</script>
