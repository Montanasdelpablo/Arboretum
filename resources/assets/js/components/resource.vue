<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                {{ name }} toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">
                            {{ name }} {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}
                        </span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4 v-for="(field, i) in form" :key="i">
                                    <v-select
                                        v-if="field.type === 'select'"
                                        v-model="form[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-switch
                                        v-if="field.type === 'switch'"
                                        v-model="form[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-checkbox
                                        v-if="field.type === 'checkbox'"
                                        v-model="form[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-text-field
                                        v-else
                                        v-model="form[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">
                            {{ name }}
                            {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }}
                        </v-btn>
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
                        v-for="(header, i) in headers"
                        :class="{'text-xs-right' : header.align === 'right'}"
                        :key="i"
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
                    Weet je zeker dat je de volgende {{ name.toLowerCase() }} wil verwijderen:

                    <strong>
                        {{ deleteItem.name }}
                    </strong>?
                </v-card-text>

                <v-card-actions>
                    <v-btn flat color="green" @click="deleteItem = {}">Annuleren</v-btn>
                    <v-btn flat color="red" @click="destroy( deleteItem.id )">Verwijderen</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Chart -->
        <bar-chart
            v-if="dataset"
            :labels="labels"
            :datasets="datasets"
        />
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
		    	type: Array,
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
                formData: {},
			}
		},
		computed: {
			/**
             * Get all errors
             *
             * @returns
             */
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
				    });
                } else {
					return [];
                }
			},

            /**
             * Return headers without actions
             */
            tableFields()
            {
            	console.log(this.headers);
            	let fields = this.headers; // Prevents overwrite of this.headers
            	fields.pop();
            	console.log(fields);
                return fields;
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
				this.$store.dispatch(
					this.itemEdit !== null ? `${this.controller}Update` : `${this.controller}Store`, this.formData ).then( () => {
					if( this.errors.length === 0 )
					{
						this.data(); // Refresh data
						this.formData = {};
						this.itemEdit = null;
						this.dialog = false; // Close dialog
					}
				} );
			},

			editItem( item )
			{
				this.itemEdit = item.id;
				this.formData = Object.assign( this.formData, item );
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

			/**
             * Close dialog
			 */
			close()
			{
				this.dialog = false;
				this.formData = {};
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