<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Kleur toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Kleur {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field
                                        v-model="form.name"
                                        label="Naam"
                                        required
                                        :error-messages="errors.name"
                                    />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Kleur {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }}</v-btn>
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
                    label="Zoeken in kleuren..."
                    single-line
                    hide-details
                />
            </v-card-title>

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

                <template slot="headerCell" slot-scope="props">
                    <v-tooltip bottom v-if="props.header.sortable !== false">
                        <span slot="activator">{{ props.header.text }}</span>
                        <span>Sorteer op {{ props.header.text }}</span>
                    </v-tooltip>

                    <span v-else>{{ props.header.text }}</span>
                </template>

                <template slot="items" slot-scope="props">
                    <tr>
                        <td>{{ props.item.name }}</td>
                        <td class="text-xs-right">{{ props.item.bloom_colors_count }}</td>
                        <td class="text-xs-right">{{ props.item.macule_colors_count }}</td>
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
        </v-card>

        <!-- Delete dialog -->
        <v-dialog v-model="Object.keys( deleteItem ).length > 1" style="max-width: 400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Kleur verwijderen</span>
                </v-card-title>

                <v-card-text>
                    Weet je zeker dat je de volgende kleur wil verwijderen: <strong>{{ deleteItem.name }}</strong>?
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
						text: 'Kleur',
						align: 'left',
						value: 'name'
					},
                    {
                    	text: 'Bloeikleur',
                        align: 'right',
                        value: 'bloom_colors_count'
                    },
                    {
                    	text: 'Maculekleur',
                        align: 'right',
						value: 'macule_colors_count'
                    },
                    {
						text: 'Acties',
						align: 'left',
						value: '',
						sortable: false,
					},
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
			 * @returns {colorIndex|default.mutations.colorIndex|default.actions.colorIndex|default.getters.colorIndex}
			 */
			items()
			{
				return this.$store.getters.colorIndex;
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.colorTotal|colorTotal}
			 */
			totalItems()
			{
				return this.$store.getters.colorTotal;
			},

            /**
             * Get the total amount of pages
             *
             * @return number
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
             * Get the labels for the chart
             * @returns [labels]
             */
            labels()
            {
            	return this.items.map( color => {
            		return color.name;
                })
            },

            /**
             * Generate the dataset for the chart
             * @returns [dataset]
             */
            datasets()
            {
            	return [
					{
						label: 'Bloeikleur',
						backgroundColor: '#313D76',
                        data: this.items.map( color => {
                        	return color.bloom_colors_count
                        })
					},
                    {
                    	label: 'Maculekleur',
						backgroundColor: '#78B856',
                        data: this.items.map( color => {
                        	return color.macule_colors_count
                        })
                    }
                ];
            }
		},
		methods: {
			/**
			 * Fetch items
			 */
			data()
			{
				this.loading = true;
				this.$store.dispatch( 'colorIndex', this.pagination ).then( () =>
				{
					this.loading = false;
				});
			},

            /**
             *  Store item
             */
			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'colorUpdate' : 'colorStore', this.form ).then( () =>
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

			editItem( item )
			{
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
				this.$store.dispatch( 'colorDestroy', id ).then( () =>
				{
					this.data(); // Refresh data
					this.deleteItem = {};
				} );
			},

			close()
			{
                this.dialog = false;
                this.form = {};
                this.itemEdit = null;
			},
		},

		watch: {
			pagination: {
				handler()
				{
					this.data();
				}
			}
		},
	}
</script>
