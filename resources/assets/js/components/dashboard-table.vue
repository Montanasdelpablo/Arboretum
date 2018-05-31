<template>
    <div>
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
                    <th v-for="header in props.headers" :key="header.text">
                        <v-icon small>arrow_upward</v-icon>
                        {{ header.text }}
                    </th>
                    <th>Acties</th>
                </tr>
            </template>

            <template slot="items" slot-scope="props">
                <tr>
                    <td
                        v-for="header in (headers.splice(headers.length, 1))"
                        :class="{'text-xs-right' : header.align === 'right'}"
                        :key="header.id"
                    >
                        {{ props.item[header.value] }}
                    </td>

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
                    <span class="headline">{{ name }} verwijderen</span>
                </v-card-title>

                <v-card-text>
                    Weet je zeker dat je de volgende {{ name }} wil verwijderen:
                    <strong>{{ deleteItem.name }}</strong>?
                </v-card-text>

                <v-card-actions>
                    <v-btn flat color="green" @click="deleteItem = {}">Annuleren</v-btn>
                    <v-btn flat color="red" @click="destroy( deleteItem.id )">Verwijderen</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Chart -->
        <bar-chart :labels="labels" :datasets="datasets" v-if="dataset" />
    </div>
</template>

<script>
	import barChart from '@/components/bar-chart';

	export default
	{
		components: {
			'bar-chart': barChart
		},

        props: {
		    headers: {
		    	type: Array,
                required: true
            },
            name: {
		    	type: String,
                required: true,
            },
            controller: {
		    	type: String,
                required: true,
            },
            form: {
		    	type: Object,
                required: true,
			},
            dataset: {
		    	type: Array,
                required: false,
            }
        },

		data()
		{
			return {
				pagination: {},
				loading: false,
				deleteItem: {},
				itemEdit: null,
				dialog: false,
			}
		},
		computed: {
			/**
			 * Get all items
			 *
			 * @returns {colorIndex|default.mutations.colorIndex|default.actions.colorIndex|default.getters.colorIndex}
			 */
			items()
			{
				return this.$store.getters[`${this.controller}Index`];
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.colorTotal|colorTotal}
			 */
			totalItems()
			{
				return this.$store.getters[`${this.controller}Total`];
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
				return this.items.map( item => {
					return item.name;
				})
			},

			/**
			 * Generate the dataset for the chart
			 * @returns [dataset]
			 */
			datasets()
			{
				if( this.dataset )
                {
				return this.dataset.map( data => {
					return {
						label: data.label,
                        backgroundColor: data.color ? data.color : '#fff',
                        data: this.items.map( item => {
                        	return item[data.item];
                        })
                    }
				});} else {
					return [];
                }
			}
		},
		methods: {
			/**
			 * Fetch items
			 */
			data()
			{
				this.loading = true;
				this.$store.dispatch( `${this.controller}Index`, this.pagination ).then( () =>
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
				this.$store.dispatch( this.itemEdit !== null ? `${this.controller}Update` : `${this.controller}Store`, this.form ).then( () =>
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
				this.$store.dispatch( `${this.controller}Destroy`, id ).then( () =>
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