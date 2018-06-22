<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Gebruiker toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Gebruiker {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field
                                        v-model="form.email"
                                        label="Email"
                                        required
                                        :error-messages="errors.email"
                                    />

                                    <v-text-field
                                        type="password"
                                        v-model="form.password"
                                        label="Wachtwoord"
                                        :required="this.itemEdit === null"
                                        :error-messages="errors.password"
                                    />

                                    <v-text-field
                                        v-model="form.first_name"
                                        label="Voornaam"
                                        required
                                        :error-messages="errors.first_name"
                                    />
                                    <v-text-field
                                        v-model="form.last_name"
                                        label="Achternaam"
                                        required
                                        :error-messages="errors.last_name"
                                    />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Gebruiker {{ this.itemEdit !== null ? 'opslaan' :
                                                                  'toevoegen' }}
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>

        <v-card>
            <v-card-title>
                <span class="headline">{{ this.$route.meta.title }}</span>

                <v-spacer></v-spacer>

                <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Zoeken in gebruikers..."
                    single-line
                    hide-details
                />
            </v-card-title>

            <v-menu
                v-model="contextMenu"
                :position-x="cMenu.x"
                :position-y="cMenu.y"
                offset-y
                absolute
            >
                <v-list>
                    <v-list-tile @click="editItem( 'context' )">
                        <v-list-tile-title> Bewerken</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="deleteFromContext( 'context' )">
                        <v-list-tile-title> Verwijderen</v-list-tile-title>
                    </v-list-tile>
                </v-list>

            </v-menu>

            <!-- Data table -->
            <v-data-table
                :search="search"
                :headers="headers"
                :items="items"
                :totalItems="totalItems"
                item-key="id"
                :loading="loading"
                :pagination.sync="pagination"
                no-data-text="Geen data"
                no-result-text="Geen resultaten gevonden"
                rows-per-page-text="Rijen per pagina"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="headerCell" slot-scope="props">
                    <v-tooltip bottom v-if="props.header.sortable !== false">
                        <span slot="activator">{{ props.header.text }}</span>
                        <span>Sorteer op {{ props.header.text }}</span>
                    </v-tooltip>

                    <span v-else>{{ props.header.text }}</span>
                </template>

                <template slot="items" slot-scope="props">
                    <tr @contextmenu.prevent="showContext(props.item, $event)">
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.first_name }}</td>
                        <td>{{ props.item.last_name }}</td>
                        <td class="justify-center layout px-0">
                            <v-tooltip bottom>
                                <v-btn class="mx-0" slot="activator" icon @click.native="editItem( props.item )">
                                    <v-icon color="green">edit</v-icon>
                                </v-btn>
                                <span>Gebruiker bewerken</span>
                            </v-tooltip>

                            <v-tooltip bottom>
                                <v-btn class="mx-0" slot="activator" icon @click="deleteItem = props.item">
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                                <span>Gebruiker verwijderen</span>
                            </v-tooltip>
                        </td>
                    </tr>
                </template>
            </v-data-table>

            <div class="text-xs-center">
                <v-pagination v-model="pagination.page" :length="pages" total-visible="7"/>
            </div>
        </v-card>

        <!-- Delete dialog -->
        <v-dialog v-model="Object.keys( deleteItem ).length > 1" width="400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Gebruiker verwijderen</span>
                </v-card-title>

                <v-card-text >
                    Weet je zeker dat je deze gebruiker wil verwijderen:
                    <strong v-if="!deleteItem.first_name && !deleteItem.last_name">{{ deleteItem.email }}</strong>
                    <strong v-else>{{ deleteItem.first_name }} {{ deleteItem.last_name }}</strong>
                    ?
                </v-card-text>

                <v-card-actions>
                    <v-btn flat color="green" @click="deleteItem = {}">Annuleren</v-btn>
                    <v-btn flat color="red" @click="destroy( deleteItem.id )">Verwijderen</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>

	export default {
		components: {},

		data()
		{
			return {
				search: '',
				pagination: {},
				loading: false,
				deleteItem: {},
				itemEdit: null,
				dialog: false,
				contextMenu: false,
				selected: {
					item: {},
				},
				cMenu: {
					x: 0,
					y: 0,
				},
				form: {},
				headers: [
					{
						text: 'Email',
						align: 'left',
						value: 'email'
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
			errors()
			{
				return this.$store.getters.errors;
			},
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

            /**
             * Calculate total page numbers
             */
			pages()
			{
				if( this.pagination.rowsPerPage == null || this.pagination.totalItems == null )
				{
					return 0;
				}

				return Math.ceil( this.items.length / this.pagination.rowsPerPage );
			},

            /**
             * Generate labels
             */
			labels()
			{
				return this.items.map( item =>
				{
					return item.email;
				} )
			},

            /**
             * Generate dataset
             */
			datasets()
			{
				return [
					{
						label: 'Gebruikers',
						backgroundColor: '#fff',
						data: this.items.map( item =>
						{
							return item.user_count
						} )
					}
				];
			},
		},
		methods: {
			/**
             * Show a context menu
             */
			showContext( item, e )
			{
				// reset
				this.cMenu.x = 0;
				this.cMenu.y = 0;
				this.contextMenu = false;

				// set coordinates for context menu
				this.cMenu.x = e.clientX;
				this.cMenu.y = e.clientY;

				// set selected id
				this.selected.item = item;

				// set context menu to visible
				this.contextMenu = true;
			},

			/**
			 * Fetch items
			 */
			data()
			{
				// Grab data
				this.loading = true;
				this.$store.dispatch( 'userIndex', this.pagination ).then( () =>
				{
					this.loading = false;
				} );
			},

			/**
			 * Store item
			 */
			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'userUpdate' : 'userRegister', this.form ).then( () =>
				{
					if( this.errors.length === 0 )
					{
						this.data(); // Refresh data
						this.form = {};
						this.itemEdit = null;
						this.dialog = false; // Close dialog
					}
				} );
			},

            /**
             * Edit an item
             */
			editItem( item )
			{
				if( item === 'context' )
				{
					// reset
					this.contextMenu = false;
					let newItem = this.selected.itemId;

					// find data for selected item
					item = newItem;
				}
				this.itemEdit = item.id;
				this.form = Object.assign( this.form, item );
				this.dialog = true; // Open dialog
			},

			/**
			 * Delete item
			 *
			 * @param id
			 */
			deleteFromContext( test )
			{
				if( test === 'context' )
				{
					// reset
					this.contextMenu = false;
					let newItem = this.selected.item;

					// set newItem
                    this.deleteItem = {
                    	id: newItem.id,
                        name: newItem.name,
                        email: newItem.email,
                    };
				}
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
				} );
			},

			/**
             * Close dialog
			 */
			close()
			{
				this.dialog = false;
				this.form = {};
				this.itemEdit = null;
			}
		},

		watch: {
			pagination: {
				handler()
				{
					this.data();
				}
			}
		}
	}
</script>
