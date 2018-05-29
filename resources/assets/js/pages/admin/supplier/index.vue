<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Leverancier toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Leverancier {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field v-model="form.name" label="Naam" required />
                                </v-flex>

                                <v-flex xs12 sm6 md9>
                                    <v-text-field v-model="form.street" label="Straat" />
                                </v-flex>

                                <v-flex xs12 sm6 md3>
                                    <v-text-field v-model="form.number" type="number" label="Nummer" />
                                </v-flex>

                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="form.addition" label="Nummer toevoeging" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.zip_code" label="Postcode" maxlength="6" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.city" label="Plaats" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.phone_number" label="Telefoonnummer" maxlength="10" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.website" type="url" label="Website url" />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Leverancier {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }}</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>

        <!-- Data table -->
        <v-data-table
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
            <template slot="header" slot-scope="props">
                <tr>
                    <th
                        v-for="header in props.headers"
                        :key="header.text"
                    >
                        <v-icon small>arrow_upward</v-icon>
                        {{ header.text }}
                    </th>
                    <th>Acties</th>
                </tr>
            </template>

            <template slot="items" slot-scope="props">
                <tr>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.street }}</td>
                    <td class="text-xs-right">{{ props.item.number }}</td>
                    <td>{{ props.item.zip_code }}</td>
                    <td>{{ props.item.city }}</td>
                    <td class="text-xs-right">{{ props.item.phone_number }}</td>
                    <td>
                        <span v-if="props.item.website">
                            <a :href="props.item.website" target="_blank">{{ props.item.name }}</a>
                        </span>
                    </td>
                    <td class="text-xs-right">{{ props.item.plant_count }}</td>
                    <td>
                        <v-btn icon @click.nativ="editItem( props.item )">
                            <v-icon color="green">edit</v-icon>
                        </v-btn>

                        <v-btn icon @click="deleteItem={ name: props.item.name, id: props.item.id }">
                            <v-icon color="red">delete</v-icon>
                        </v-btn>
                    </td>
                </tr>
            </template>
        </v-data-table>

        <div class="text-xs-center">
            <v-pagination v-model="pagination.page" :length="pages" total-visible="7" />
        </div>

        <!-- Delete dialog -->
        <v-dialog v-model="Object.keys( deleteItem ).length > 1" style="max-width: 400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Leverancier verwijderen</span>
                </v-card-title>

                <v-card-text>
                    Weet je zeker dat je de volgende leverancier wil verwijderen: <strong>{{ deleteItem.name }}</strong>?
                </v-card-text>

                <v-card-actions>
                    <v-btn flat color="green" @click="deleteItem = {}">Annuleren</v-btn>
                    <v-btn flat color="red" @click="destroy( deleteItem.id )">Verwijderen</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Chart -->
        <bar-chart :labels="labels" :datasets="datasets" />
    </div>
</template>

<script>
	import barChart from '@/components/bar-chart';

	export default
	{
		components: {
			'bar-chart': barChart
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
						text: 'Leverancier',
						align: 'left',
						value: 'name'
					},
                    {
                        text: 'Straat',
                        align: 'left',
                        value: 'street',
                    },
                    {
						text: 'Nummer',
						align: 'right',
						value: 'number',
					},
					{
						text: 'Postcode',
						align: 'left',
						value: 'zip_code',
					},
					{
						text: 'Plaats',
						align: 'left',
						value: 'city',
					},
					{
						text: 'Telefoonnummer',
						align: 'right',
						value: 'phone_number',
					},
					{
						text: 'Website',
						align: 'left',
						value: 'website',
					},
					{
						text: 'Planten',
						align: 'right',
						value: 'plant_count'
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
			 *
             *
             * {supplierIndex|default.mutations.supplierIndex|default.actions.supplierIndex|default.getters.supplierIndex}
			 */
			items()
			{
				return this.$store.getters.supplierIndex;
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.supplierTotal|supplierTotal}
			 */
			totalItems()
			{
				return this.$store.getters.supplierTotal;
			},

			pages()
			{
				if( this.pagination.rowsPerPage == null || this.pagination.totalItems == null )
				{
					return 0;
				}

				return Math.ceil( this.items.length / this.pagination.rowsPerPage );
			},

			labels()
			{
				return this.items.map( item => {
					return item.name;
				})
			},

			datasets()
			{
				return [
					{
						label: 'Planten',
						backgroundColor: '#fff',
						data: this.items.map( item => {
							return item.plant_count
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
				this.loading = true;
				this.$store.dispatch( 'supplierIndex', this.pagination ).then( () => {
					this.loading = false;
				});
			},


			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'supplierUpdate' : 'supplierStore', this.form ).then(
					() =>
					{
						this.data(); // Refresh data
						this.form = {};
						this.itemEdit = null;

						if( this.errors.length === 0 )
						{
							this.dialog = false; // Close dialog
						}
					});
			},

			editItem( item )
			{
				delete item.plant_count;

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
				this.$store.dispatch( 'supplierDestroy', id ).then( () =>
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
