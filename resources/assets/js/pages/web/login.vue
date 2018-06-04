<template>
    <v-container fluid>
        <v-layout column align-center justify-center>
            <v-container
                style="min-height: 0; padding-top: 150px; background-color: #ffffff"
                :class="{'px-0': $vuetify.breakpoint.xsOnly }"
            >
                <v-flex xs12 sm6 offset-sm3>
                    <v-alert dismissible v-on:click="hideAlert" v-model="alert" :type="success ? 'success' : 'error'" :value="message && message.length > 1" transition="scale-transition">
                        {{ message }}
                    </v-alert>

                    <form @submit.prevent="login">
                        <v-text-field
                            v-model="loginForm.email"
                            type="email"
                            label="Email-adres"
                            :error-messages="errors['email']"
                            required
                        />

                        <v-text-field
                            v-model="loginForm.password"
                            label="Wachtwoord"
                            :append-icon="passwordVisible ? 'visibility_off' : 'visibility'"
                            :append-icon-cb="() => (passwordVisible = !passwordVisible)"
                            :type="passwordVisible ? 'text' : 'password'"
                            minlength="6"
                            :error-messages="errors['password']"
                            :counter="15"
                            required
                        />

                        <v-btn color="primary" type="submit">Inloggen</v-btn>
                    </form>

                    <v-dialog v-model="forgotpassword" max-width="500px">
                        <v-btn
                            slot="activator"
                            flat
                            color="primary"
                            style="float:right"
                            dark
                            @click.stop="forgotpassword = true"
                        >
                            Wachtwoord vergeten
                        </v-btn>

                        <v-card>
                            <form @submit.prevent="forgotPassword">
                                <v-card-title>Wachtwoord vergeten</v-card-title>

                                <v-card-text>
                                    <v-text-field
                                        v-model="forgotEmail"
                                        type="email"
                                        label="Email"
                                        required
                                    />
                                </v-card-text>

                                <v-card-actions right>
                                    <v-btn color="primary" type="submit">Verstuur wachtwoord</v-btn>
                                    <v-btn color="primary" flat @click.stop="forgotpassword=false">Sluiten</v-btn>
                                </v-card-actions>
                            </form>
                        </v-card>
                    </v-dialog>
                </v-flex>
            </v-container>
        </v-layout>
    </v-container>
</template>

<script>
	import { mapGetters } from 'vuex';

	export default {
		metaInfo: {
			title: 'Login'
		},

		computed: {
			...mapGetters( [
				'message',
				'success',
				'errors',
				'userProfile',
				'alert',
			] ),
		},

		data()
		{
			return {
				activity: 1,
				valid: false,
				loginForm: {},
				forgotEmail: '',
				forgotpassword: false,
                passwordVisible: false,
			}
		},

		methods: {
			login()
			{
				this.$store.dispatch( 'userLogin', this.loginForm ).then( () =>
				{
					//this.data(); // Refresh data
					this.loginForm.password = '';

					if( sessionStorage.getItem( 'token' ) && sessionStorage.getItem( 'token' ).length > 0 )
					{
						this.$router.push( {name: 'dashboard'} );
					}
				} );
			},

			forgotPassword()
			{
				let user = {
					email: this.forgotEmail
				};

				this.$store.dispatch( 'forgotPassword', user ).then( () =>
				{
					//this.data(); // Refresh data
				} );
			},

            hideAlert()
			{
				this.$store.commit( 'hideAlert' );
			}
		},
	}

</script>
