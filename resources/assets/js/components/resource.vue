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
                                        v-model="formData[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                        autocomplete
                                        :items="field.items"
                                        item-text="name"
                                        item-value="id"
                                        :no-data="`Geen ${field.name.toLowerCase()} gevonden`"
                                        cache-items
                                        :search-input.sync="field.search"
                                    />

                                    <v-switch
                                        v-if="field.type === 'switch'"
                                        v-model="formData[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-checkbox
                                        v-if="field.type === 'checkbox'"
                                        v-model="formData[field.name]"
                                        :label="field.label"
                                        :required="field.required"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-text-field
                                        v-if="field.type === 'number'"
                                        v-model.number="formData[field.name]"
                                        :type="field.type"
                                        :label="field.label"
                                        :required="field.required"
                                        :maxlength="field.maxLength"
                                        :minlength="field.minLength"
                                        :error-messages="errors[field.name]"
                                    />

                                    <v-text-field
                                        v-else
                                        v-model="formData[field.name]"
                                        :type="field.type"
                                        :label="field.label"
                                        :required="field.required"
                                        :maxlength="field.maxLength"
                                        :minlength="field.minLength"
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

        <v-card>
            <v-card-title>
                <span class="headline">{{ this.$route.meta.title }}</span>

                <v-spacer></v-spacer>

                <v-text-field
                    v-model="search"
                    append-icon="search"
                    :label="`Zoeken in ${this.$route.meta.title.toLowerCase()}...`"
                    single-line
                    hide-details
                />
            </v-card-title>

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
                <v-progress-linear slot="progress" color="secondary" indeterminate></v-progress-linear>

                <template slot="headerCell" slot-scope="props">
                    <v-tooltip bottom v-if="props.header.sortable !== false">
                        <span slot="activator">{{ props.header.text }}</span>
                        <span>Sorteer op {{ props.header.text }}</span>
                    </v-tooltip>

                    <span v-else>{{ props.header.text }}</span>
                </template>

                <template slot="items" slot-scope="props">
                        <td
                            v-for="(header, i) in headers"
                            v-if="header.value"
                            :class="{'text-xs-right' : header.align === 'right'}"
                            :key="i"
                        >
                            <span v-if="props.item[header.value] && header.url">
                                <a :href="props.item[header.value]" target="_blank">{{ props.item[header.value] }}</a>
                            </span>

                            <span
                                v-if="props.item[header.value] instanceof Object && props.item[header.value].length > 0"
                            >
                                {{ props.item[header.value].map( item => item.name ).join( ', ' ) }}
                            </span>

                            <span v-if="header.boolean">
                                <v-icon v-if="props.item[header.value]" class="green--text">check_box</v-icon>
                            <v-icon v-else class="red--text">check_box_outline_blank</v-icon>
                            </span>

                            <span v-else>{{ props.item[header.value] }}</span>
                        </td>

                        <td v-else>
                            <v-btn icon @click.native="editItem( props.item )">
                                <v-icon color="green">edit</v-icon>
                            </v-btn>

                            <v-btn icon @click="deleteItem={ name: props.item.name, id: props.item.id }">
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </td>
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
            defaultForm: {
		    	type: Object,
                required: false
            },
            dataset: {
		    	type: Array,
                required: false,
            }
        },

		data()
		{
			return {
				search: '',
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
						this.resetForm();
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
				this.resetForm();
				this.itemEdit = null;
			},

			/**
             * Reset the formData to the default
			 */
			resetForm()
			{
            	this.formData = this.defaultForm ? this.defaultForm : {}
            }
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