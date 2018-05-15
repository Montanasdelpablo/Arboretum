<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>
            <v-container style="min-height: 0; padding-top: 150px; background-color: #ffffff" :class="{'px-0': $vuetify.breakpoint.xsOnly }">


            <v-alert v-show="success" :value="true" type="success">
                  {{ notification }}
            </v-alert>

            <v-alert v-show="failure" :value="true" type="warning">
                {{ notification }}
            </v-alert>

            <v-flex xs12 sm6 offset-sm3>
                  <v-form v-model="valid" @submit.prevent="register">
                        <v-text-field
                            v-model="form.email"
                            :counter="10"
                            label="Email-adres"
                            required
                        />

                      <v-text-field
                          v-model="form.password"
                          label="Wachtwoord"
                          type="password"
                          required
                      />

                      <v-text-field
                          v-model="form.first_name"
                          label="Voornaam"
                          required
                      />
                      <v-text-field
                          v-model="form.last_name"
                          label="Achternaam"
                          required
                      />

                      <v-btn
                          style="float:right"
                          :disabled="!valid"
                          type="submit"
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
                form: {},
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
                ],
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => v.length >= 3 || 'Password must be more than 3 characters'
                ],
                success: false,
                failure: false,
                notification: '',
            }
        },
		methods: {
        register(){
          let user = this.form;
          this.$store.dispatch( 'register', user ).then( (res) =>
          {
            // this.data(); // Refresh data
            // See whether success or failure
            console.log(res);
            if(res){
              this.success = true;
              this.failure = false;
              this.notification = "Yay! Everything went fine.";
            } else {
              this.success = false;
              this.failure = true;
              this.notification = "Something has gone wrong!";
            }
          });
        },
		},
	}
</script>
