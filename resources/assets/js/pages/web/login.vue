<template>
    <v-container fluid>
        <v-parallax :src="image" height="700">
            <v-layout column align-center justify-center>


            <v-container style="min-height: 0; padding-top: 150px; background-color: #ffffff" :class="{'px-0': $vuetify.breakpoint.xsOnly }">
            <v-flex xs12 sm6 offset-sm3>


            <v-alert v-show="success" :value="true" type="success">
                  {{ notification }}
            </v-alert>

            <v-alert v-show="failure" :value="true" type="success">
                {{ notification }}
            </v-alert>

            <v-form ref="loginForm" v-model="valid">
                      <v-text-field
                        v-model="loginForm.email"

                        label="Email-adres"
                        required
                      ></v-text-field>
                      <v-text-field
                        v-model="loginForm.password"

                        label="Wachtwoord"
                        type="password"
                        :counter="15"
                        required
                      ></v-text-field>

                      <v-btn color="primary" dark @click.stop="forgotpassword = true">Wachtwoord vergeten</v-btn>


                      <v-btn
                           color="primary"
                           style="float:right"
                           :disabled="!valid"
                           @click="submit"
                         >
                           submit
                        </v-btn>
                      </v-form>

                      <v-dialog v-model="forgotpassword" max-width="500px">
                            <v-card>
                              <v-card-title>
                                Wachtwoord vergeten
                              </v-card-title>
                              <v-card-text>
                              <v-form ref="forgotForm" v-model="valid">
                                        <v-text-field
                                          v-model="forgotEmail"

                                          label="Email"
                                          required
                                        ></v-text-field>

                                        <v-btn
                                             color="primary"
                                             style="float:right"
                                             :disabled="!valid"
                                             @click="verstuur"
                                           >
                                             Verstuur wachtwoord
                                          </v-btn>
                                        </v-form>
                              </v-card-text>
                              <v-card-actions>
                                <v-btn color="primary" flat @click.stop="forgotpassword=false">Sluiten</v-btn>

                              </v-card-actions>
                            </v-card>
                          </v-dialog>
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
			title: 'login'
		},
		data()
		{
			return {
				image: 'https://images.pexels.com/photos/573552/pexels-photo-573552.jpeg?w=940&h=650&dpr=2&auto=compress&cs=tinysrgb',
				activity: 1,
        valid: false,
        loginForm: {},
        forgotEmail: '',
        forgotpassword: false,
        success: false,
        failure: false,
        notification: '',
			}
		},
		methods: {
        submit () {
           if (this.$refs.loginForm.validate()) {
             // Native form submission is not yet supported
             this.login();
           }
        },
        verstuur () {
           if (this.$refs.forgotForm.validate()) {
             // Native form submission is not yet supported
             this.forgotPassword();
           }
        },
			  login(){
          this.$store.dispatch( 'login', this.loginForm ).then( () =>
          {
            //this.data(); // Refresh data
          });
        },
        forgotPassword(){
          let user = {
            email: this.forgotEmail
          }
          this.$store.dispatch( 'forgotPassword', user ).then( () =>
          {
            //this.data(); // Refresh data
          });
        }
		  },
		}

</script>
