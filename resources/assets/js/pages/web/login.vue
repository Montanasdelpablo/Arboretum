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
                              <v-form v-model="valid">
                                        <v-text-field
                                          v-model="forgotEmail"
                                          :rules="emailRules"
                                          :counter="10"
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
        forgotEmail: '',
        forgotpassword: false,
			}
		},
		methods: {
			  login(){
          <!-- Gather info needed for login -->
          let user = {
            email: this.email,
            password: this.password,
          }
          <!-- Make request to api -->
          this.$store.dispatch( 'login', user ).then( () =>
          {
            this.data(); // Refresh data
          });
        },
        forgotPassword(){
          <!-- Gather info needed for forgetting password -->
          let user = {
            email: this.forgotEmail
          }
          <!-- Make request to api -->
          this.$store.dispatch( 'forgotPassword', user ).then( () =>
          {
            this.data(); // Refresh data
          });
        }
			},
		},
	}
</script>
