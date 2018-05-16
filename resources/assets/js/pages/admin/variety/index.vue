<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Variëteit toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Variëteit {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="form.name" label="Naam" required />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Variëteit Opslaan</v-btn>
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

        <!-- Delete dialog -->
        <v-dialog v-model="Object.keys( deleteItem ).length > 1" style="max-width: 400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Variëteit verwijderen</span>
                </v-card-title>

                <v-card-text>
                    Weet je zeker dat je de volgende variëteit wil verwijderen: <strong>{{ deleteItem.name }}</strong>?
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
	export default
	{
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
						text: 'Variëteit',
						align: 'left',
						value: 'name'
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
			 * {varietyIndex|default.mutations.varietyIndex|default.actions.varietyIndex|default.getters.varietyIndex}
			 */
			items()
			{
				return this.$store.getters.varietyIndex;
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.varietyTotal|varietyTotal}
			 */
			totalItems()
			{
				return this.$store.getters.varietyTotal;
			}
		},
		methods: {
			/**
			 * Fetch items
			 */
			data()
			{
				this.loading = true;
				this.$store.dispatch( 'varietyIndex', this.pagination ).then( () => {
					this.loading = false;
				});
			},


			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'varietyUpdate' : 'varietyStore', this.form ).then(
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
				this.$store.dispatch( 'varietyDestroy', id ).then( () =>
				{
					this.data(); // Refresh data
					this.deleteItem = {};
				});
			},

			close()
			{
				this.dialog = false;
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