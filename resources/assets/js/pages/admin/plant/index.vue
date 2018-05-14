<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Plant toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Plant {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field v-model="form.follow_number" label="Volgnummer" type="number" required />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.purchase_number" label="Aankoopnummer" type="number" required />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.type_id"
                                        label="Type"
                                        autocomplete
                                        :items="types"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen type gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['type_id']"
                                        :search-input.sync="typeSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.sex_id"
                                        label="Geslacht"
                                        autocomplete
                                        :items="sexes"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen geslachten gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['sex_id']"
                                        :search-input.sync="sexSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.specie_id"
                                        label="Soortnaam"
                                        autocomplete
                                        :items="species"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen soort gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['specie_id']"
                                        :search-input.sync="specieSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.variety_id"
                                        label="Variëteitsnaam"
                                        autocomplete
                                        :items="varieties"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen variëteit gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['type_id']"
                                        :search-input.sync="varietySearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.group_id"
                                        label="Groep"
                                        autocomplete
                                        :items="groups"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen groepen gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['group_id']"
                                        :search-input.sync="groupSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.name" label="Naam" required />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.synonym_id"
                                        label="Synoniem"
                                        autocomplete
                                        :items="synonyms"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen synoniem gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['synonym_id']"
                                        :search-input.sync="synonymSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.crossing_id"
                                        label="Kruizing ouders"
                                        autocomplete
                                        :items="crossings"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen kruisingen gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['crossing_id']"
                                        :search-input.sync="crossingSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.winner_id"
                                        label="Winner"
                                        autocomplete
                                        :items="winners"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen winner gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['winner_id']"
                                        :search-input.sync="winnerSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.control" label="Controle" type="date" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.treetype_id"
                                        label="Boomtype"
                                        autocomplete
                                        :items="treetypes"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen boomtype gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['treetype_id']"
                                        :search-input.sync="treetypeSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.priority_id"
                                        label="Belang"
                                        autocomplete
                                        :items="priorities"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen belang gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['priority_id']"
                                        :search-input.sync="prioritySearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.place" label="Plaats" required />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.latitude" label="Latitude" required />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.longitude" label="Longitude" required />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-checkbox v-model="form.replant" label="Herplant" />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-text-field v-model="form.moved" label="Verplaatst" type="date" />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-checkbox v-model="form.dead" label="Dood" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.supplier_id"
                                        label="Leverancier"
                                        autocomplete
                                        :items="suppliers"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen leverancier gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['supplier_id']"
                                        :search-input.sync="supplierSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.planted" label="Poot datum" type="date" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.bloom_color"
                                        label="Bloeikleur"
                                        multiple
                                        autocomplete
                                        :items="colors"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen kleur gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['bloom_color']"
                                        :search-input.sync="colorSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.bloom_date"
                                        label="Bloeitijd"
                                        multiple
                                        autocomplete
                                        :items="months"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen maand gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['month_id']"
                                        :search-input.sync="monthSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.macule_color"
                                        label="Maculekleur"
                                        multiple
                                        autocomplete
                                        :items="colors"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen kleur gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['macule_color']"
                                        :search-input.sync="colorSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.size_id"
                                        label="Grootte"
                                        autocomplete
                                        :items="sizes"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen grootte gevonden"
                                        cache-items
                                        required
                                        :error-messages="errors['size_id']"
                                        :search-input.sync="sizeSearch"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.note" label="Aantekening" />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field v-model="form.description" label="Beschrijving" />
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Plant Opslaan</v-btn>
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
                    <td>{{ props.item.follow_number }}</td>
                    <td>{{ props.item.purchase_number }}</td>
                    <td>{{ props.item.type.name }}</td>
                    <td>{{ props.item.sex.name }}</td>
                    <td>{{ props.item.specie.name }}</td>
                    <td>{{ props.item.variety.name }}</td>
                    <td>{{ props.item.group.name }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.synonym.name }}</td>
                    <td>{{ props.item }}</td>
                    <td>{{ props.item.winner.name }}</td>
                    <td>{{ props.item.treetype.name }}</td>
                    <td>{{ props.item.priority.name }}</td>
                    <td>{{ props.item.place }}</td>
                    <td>{{ props.item.latitude }}</td>
                    <td>{{ props.item.longitude }}</td>
                    <td>{{ props.item.replant }}</td>
                    <td>{{ props.item.moved }}</td>
                    <td>{{ props.item.dead }}</td>
                    <td>{{ props.item.supplier.name }}</td>
                    <td>{{ props.item.planted }}</td>
                    <td>{{ props.item }}</td>
                    <td>{{ props.item }}</td>
                    <td>{{ props.item }}</td>
                    <td>{{ props.item }}</td>
                    <td>{{ props.item.note }}</td>
                    <td>{{ props.item.description }}</td>
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
                    <span class="headline">Plant verwijderen</span>
                </v-card-title>

                <v-card-text>
                    Weet je zeker dat je de volgende plant wil verwijderen: <strong>{{ deleteItem.name }}</strong>?
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
                    	text: 'Volgnummer',
                        align: 'right',
                        value: 'follow_number'
                    },
					{
						text: 'Aankoopnummer',
						align: 'right',
						value: 'purchase_number'
					},
					{
						text: 'Bloemtype',
						align: 'left',
						value: 'type'
					},
					{
						text: 'Geslacht',
						align: 'left',
						value: 'sex'
					},
					{
						text: 'Soortnaam',
						align: 'left',
						value: 'specie'
					},
					{
						text: 'Variëteitsnaam',
						align: 'right',
						value: 'variety'
					},
					{
						text: 'Groep',
						align: 'right',
						value: 'group'
					},
					{
						text: 'Naam',
						align: 'right',
						value: 'name'
					},
					{
						text: 'Synoniem',
						align: 'right',
						value: 'synonym'
					},
					{
						text: 'Kruising ouders',
						align: 'right',
						value: ''
					},
					{
						text: 'Winner',
						align: 'right',
						value: 'winner'
					},
					{
						text: 'Boomtype',
						align: 'right',
						value: 'treetype'
					},
					{
						text: 'Belang',
						align: 'right',
						value: 'priority'
					},
					{
						text: 'Plaats',
						align: 'right',
						value: 'place'
					},
					{
						text: 'Latitude',
						align: 'right',
						value: 'latitude'
					},
					{
						text: 'Longitude',
						align: 'right',
						value: 'longitude'
					},
					{
						text: 'Herplant',
						align: 'right',
						value: 'replant'
					},
					{
						text: 'Verplaatst',
						align: 'right',
						value: 'moved'
					},
					{
						text: 'Dood',
						align: 'right',
						value: 'dead'
					},
					{
						text: 'Leverancier',
						align: 'right',
						value: 'supplier'
					},
					{
						text: 'Poot datum',
						align: 'right',
						value: 'planted'
					},
					{
						text: 'Bloeikleur',
						align: 'right',
						value: ''
					},
					{
						text: 'Bloeitijd',
						align: 'right',
						value: ''
					},
					{
						text: 'Maculekleur',
						align: 'right',
						value: ''
					},
					{
						text: 'Grootte',
						align: 'right',
						value: ''
					},

					{
						text: 'Aantekening',
						align: 'right',
						value: 'note'
					},

					{
						text: 'Beschrijving',
						align: 'right',
						value: 'description'
					},
					{
						text: 'Acties',
						align: 'left',
						value: '',
						sortable: false,
					}
				],
                type_id: null,
                sex_id: null,
                specie_id: null,
                variety_id: null,
                group_id: null,
                synonym_id: null,
                crossing_id: null,
                winner_id: null,
                treetype_id: null,
                priority_id: null,
                supplier_id: null,
                size_id: null,
                bloom_color: null,
                macule_color: null,
                month_id: null,
                typeSearch: null,
				sexSearch: null,
				specieSearch: null,
				varietySearch: null,
				groupSearch: null,
				synonymSearch: null,
				crossingSearch: null,
				winnerSearch: null,
				treetypeSearch: null,
				prioritySearch: null,
				supplierSearch: null,
				sizeSearch: null,
                colorSearch: null,
                monthSearch: null,
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
			 * @returns {plantIndex|default.mutations.plantIndex|default.actions.plantIndex|default.getters.plantIndex}
			 */
			items()
			{
				return this.$store.getters.plantIndex;
			},

			/**
			 * Get the total amount of items
			 * @returns {default.getters.plantTotal|plantTotal}
			 */
			totalItems()
			{
				return this.$store.getters.plantTotal;
			},

            types()
            {
            	return Object.values( this.$store.getters.typeSearch );
            },

			sexes()
			{
				return Object.values( this.$store.getters.sexSearch );
			},

			species()
			{
				return Object.values( this.$store.getters.specieSearch );
			},

			varieties()
			{
				return Object.values( this.$store.getters.varietySearch );
			},

			groups()
			{
				return Object.values( this.$store.getters.groupSearch );
			},

			synonyms()
			{
				return Object.values( this.$store.getters.synonymSearch );
			},

			crossings()
			{
				return Object.values( this.$store.getters.crossingSearch );
			},

			winners()
			{
				return Object.values( this.$store.getters.winnerSearch );
			},

			treetypes()
			{
				return Object.values( this.$store.getters.treetypeSearch );
			},

			priorities()
			{
				return Object.values( this.$store.getters.prioritySearch );
			},

			suppliers()
			{
				return Object.values( this.$store.getters.supplierSearch );
			},

			sizes()
			{
				return Object.values( this.$store.getters.sizeSearch );
			},

			colors()
			{
				return Object.values( this.$store.getters.colorSearch );
			},

			months()
			{
				return Object.values( this.$store.getters.monthSearch );
			}
		},
		methods: {
			/**
			 * Fetch items
			 */
			data()
			{
				this.loading = true;
				this.$store.dispatch( 'plantIndex', this.pagination ).then( () => {
					this.loading = false;
				});
			},


			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'plantUpdate' : 'plantStore', this.form ).then( () =>
				{
					this.data(); // Refresh data
					this.form = {};
					this.itemEdit = null;
					this.dialog = false; // Close dialog
				});
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
				this.$store.dispatch( 'plantDestroy', id ).then( () =>
				{
					this.data(); // Refresh data
					this.deleteItem = {};
				});
			},

			close()
			{
				this.dialog = false;
			},

			type( type )
            {
			    if( type && type.length >= 2 )
                {
                	this.$store.dispatch( 'typeSearch', type )
                }
            },

			sex( sex )
			{
				if( sex && sex.length >= 2 )
				{
					this.$store.dispatch( 'sexSearch', sex )
				}
			},

			specie( specie )
            {
				if( specie && specie.length >= 2 )
				{
					this.$store.dispatch( 'specieSearch', specie )
				}
			},

			variety( variety )
			{
				if( variety && variety.length >= 2 )
				{
					this.$store.dispatch( 'varietySearch', variety )
				}
			},

			group( group )
			{
				if( group && group.length >= 2 )
				{
					this.$store.dispatch( 'groupSearch', group )
				}
			},

			synonym( synonym )
			{
				if( synonym && synonym.length >= 2 )
				{
					this.$store.dispatch( 'synonymSearch', synonym )
				}
			},

			crossing( crossing )
			{
				if( crossing && crossing.length >= 2 )
				{
					this.$store.dispatch( 'crossingSearch', crossing )
				}
			},

			winner( winner )
			{
				if( winner && winner.length >= 2 )
				{
					this.$store.dispatch( 'winnerSearch', winner )
				}
			},

			priority( priority )
			{
				if( priority && priority.length >= 2 )
				{
					this.$store.dispatch( 'prioritySearch', priority )
				}
			},

			treetype( treetype )
			{
				if( treetype && treetype.length >= 2 )
				{
					this.$store.dispatch( 'treetypeSearch', treetype )
				}
			},

			supplier( supplier )
			{
				if( supplier && supplier.length >= 2 )
				{
					this.$store.dispatch( 'supplierSearch', supplier )
				}
			},

			size( size )
			{
				if( size && size.length >= 2 )
				{
					this.$store.dispatch( 'sizeSearch', size )
				}
			},

			color( color )
			{
				if( color && color.length >= 2 )
				{
					this.$store.dispatch( 'colorSearch', color )
				}
			},

			month( month )
			{
				if( month && month.length >= 2 )
				{
					this.$store.dispatch( 'monthSearch', month )
				}
			},
		},
		watch: {
			details( after )
            {
            	// Set all ids
            },

			pagination: {
				handler() {
					this.data();
				}
			},

			typeSearch( type )
			{
				this.type( type );
			},

			sexSearch( sex )
			{
				this.sex( sex );
			},

			specieSearch( specie )
			{
				this.specie( specie );
			},

			varietySearch( variety )
			{
				this.variety( variety );
			},

			groupSearch( group )
			{
				this.group( group );
			},

			synonymSearch( synonym )
			{
				this.synonym( synonym );
			},

			crossingSearch( crossing )
			{
				this.crossing( crossing );
			},

			winnerSearch( winner )
			{
				this.winner( winner );
			},

			prioritySearch( priority )
			{
				this.priority( priority );
			},

			treetypeSearch( treetype )
			{
				this.treetype( treetype );
			},

			supplierSearch( supplier )
			{
				this.supplier( supplier );
			},

			sizeSearch( size )
			{
				this.size( size );
			},

			colorSearch( color )
			{
				this.color( color );
			},

			monthSearch( month )
			{
				this.month( month );
			},
		}
	}
</script>