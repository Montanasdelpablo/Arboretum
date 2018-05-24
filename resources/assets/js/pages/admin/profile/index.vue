<template>
    <div>



        <div>
            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Gebruiker {{ this.itemEdit !== null ? 'bewerken' : '' }} </span>
                    </v-card-title>

                    <v-card-text v-if="this.itemEdit == null">
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="form.email" label="Email" required />
                                    <v-text-field v-model="form.password" label="Wachtwoord" required />
                                    <v-text-field v-model="form.first_name" label="Voornaam"  />
                                    <v-text-field v-model="form.last_name" label="Achternaam"  />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-text v-if="this.itemEdit">
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="form.email" label="Email" required />
                                    <v-text-field v-model="form.first_name" label="Voornaam"  />
                                    <v-text-field v-model="form.last_name" label="Achternaam"  />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Gebruiker {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }} </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </div>





    </div>
</template>

<script>

	export default
	{
    components: {

		},

		data()
		{
			return {
				pagination: {},
				loading: false,
				deleteItem: {},
				itemEdit: null,
				dialog: false,
				form: {},
				headers: [
					{
						text: 'Email',
						align: 'left',
						value: 'name'
					},
					{
						text: 'Voornaam',
						align: 'left',
						value: 'first_name'
					},
          {
						text: 'Achternaam',
						align: 'left',
						value: 'last_name'
					},
					{
						text: 'Acties',
						align: 'left',
						value: '',
						sortable: false,
					}
				]
			}
		},
		computed: {
			/**
			 * Get all items
			 *
			 * @returns
			 * {userIndex|default.mutations.userIndex|default.actions.userIndex|default.getters.userIndex}
			 */
			items()
			{
        return this.$store.getters.userIndex;
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.userTotal|userTotal}
			 */
			totalItems()
			{
				return this.$store.getters.userTotal;
			},

			labels()
			{
				return this.items.map( item => {
					return item.email;
				})
			},

			datasets()
			{
				return [
					{
						label: 'Gebruikers',
						backgroundColor: '#fff',
						data: this.items.map( item => {
							return item.user_count
						})
					}
				];
			},
		},
		methods: {
			/**
			 * Fetch items
			 */
			data()
			{
        // Grab data
				this.loading = true;
				this.$store.dispatch( 'userIndex', this.pagination ).then( () => {
					this.loading = false;
				});
			},


			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'userUpdate' : 'userStore', this.form ).then(
					() =>
					{
						this.data(); // Refresh data
						this.form = {};
						this.itemEdit = null;
						this.dialog = false; // Close dialog
					});
			},

			editItem( item )
			{
				delete item.user_count;
				this.itemEdit = item.id;
				this.form = Object.assign( this.form, item );
				this.dialog = true; // Open dialog
			},

			/**
			 * Delete item
			 *
			 * @param id
			 */
			destroy( id )
			{
				this.loading = true;
				this.$store.dispatch( 'userDestroy', id ).then( () =>
				{
					this.data(); // Refresh data
					this.deleteItem = {};
				});
			},

			close()
			{
        this.dialog = false;
        this.form = {};
        this.itemEdit = null;
			}
		},
		watch: {
			pagination: {
				handler() {
					this.data();
				}
			}
		}
	}
</script>
