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
                                    <v-text-field
                                        v-model="form.follow_number"
                                        label="Volgnummer"
                                        type="number"
                                        required
                                        :error-messages="errors.follow_number"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.purchase_number"
                                        label="Aankoopnummer"
                                        type="number"
                                        required
                                        :error-messages="errors.purchase_number"
                                    />
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
                                        :error-messages="errors.type_id"
                                        :search-input.sync="typeIndex"
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
                                        :error-messages="errors.sex_id"
                                        :search-input.sync="sexIndex"
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
                                        :error-messages="errors.specie_id"
                                        :search-input.sync="specieIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.subspecie_id"
                                        label="Variëteitsnaam"
                                        autocomplete
                                        :items="subspecies"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen variëteit gevonden"
                                        cache-items
                                        :error-messages="errors.type_id"
                                        :search-input.sync="subspecieIndex"
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
                                        :error-messages="errors.group_id"
                                        :search-input.sync="groupIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.name_id"
                                        label="Naam"
                                        autocomplete
                                        :items="names"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen namen gevonden"
                                        cache-items
                                        :error-messages="errors.name_id"
                                        :search-input.sync="nameIndex"
                                    />
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
                                        :error-messages="errors.synonym_id"
                                        :search-input.sync="synonymIndex"
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
                                        :error-messages="errors.crossing_id"
                                        :search-input.sync="crossingIndex"
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
                                        :error-messages="errors.winner_id"
                                        :search-input.sync="winnerIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.control"
                                        label="Controle"
                                        type="date"
                                        :error-messages="errors.control"
                                    />
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
                                        :error-messages="errors.treetype_id"
                                        :search-input.sync="treetypeIndex"
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
                                        :error-messages="errors.priority_id"
                                        :search-input.sync="priorityIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.place"
                                        label="Plaats"
                                        required
                                        :error-messages="errors.place"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.latitude"
                                        label="Latitude"
                                        required
                                        :error-messages="errors.latitude"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.longitude"
                                        label="Longitude"
                                        required
                                        :error-messages="errors.longitude"
                                    />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-checkbox
                                        v-model="form.replant"
                                        label="Herplant"
                                        :error-messages="errors.replant"
                                    />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-text-field
                                        v-model="form.moved"
                                        label="Verplaatst"
                                        type="date"
                                        :error-messages="errors.moved"
                                    />
                                </v-flex>

                                <v-flex xs12 md4>
                                    <v-checkbox
                                        v-model="form.dead"
                                        label="Dood"
                                        :error-messages="errors.dead"
                                    />
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
                                        :error-messages="errors.supplier_id"
                                        :search-input.sync="supplierIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="form.planted"
                                        label="Poot datum"
                                        type="date"
                                        :error-messages="errors.planted"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.bloom_colors"
                                        label="Bloeikleur"
                                        multiple
                                        autocomplete
                                        :items="colors"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen kleur gevonden"
                                        :error-messages="errors.bloom_color"
                                        :search-input.sync="colorIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.months"
                                        label="Bloeitijd"
                                        multiple
                                        autocomplete
                                        :items="months"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen maand gevonden"
                                        :error-messages="errors.months"
                                        :search-input.sync="monthIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="form.macule_colors"
                                        label="Maculekleur"
                                        multiple
                                        autocomplete
                                        :items="colors"
                                        item-text="name"
                                        item-value="id"
                                        no-data="Geen kleur gevonden"
                                        :error-messages="errors.macule_color"
                                        :search-input.sync="colorIndex"
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
                                        :error-messages="errors.size_id"
                                        :search-input.sync="sizeIndex"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        multi-line
                                        v-model="form.note"
                                        label="Aantekening"
                                        :error-messages="errors.note"
                                    />
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        multi-line
                                        v-model="form.description"
                                        label="Beschrijving"
                                        :error-messages="errors.description"
                                    />
                                </v-flex>

                                <v-flex xs12>

                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="getImage"
                                    >

                                    <img :src="form.image" v-if="form.image" width="100%">
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="dialog = false">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Plant {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }}</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>

        <v-btn flat :to="{ name: 'plantPrint' }">
            <v-icon>print</v-icon>
            Planten afdrukken
        </v-btn>

        <v-btn flat :to="{ name: 'plantMap' }">
            <v-icon>map</v-icon>
            Tonen op kaart
        </v-btn>

        <v-card>
            <v-card-title>
                <span class="headline">{{ this.$route.meta.title }}</span>

                <v-spacer></v-spacer>

                <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Zoeken in planten..."
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
                :headers="headers"
                :items="items"
                :search="search"
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
                        <td>{{ props.item.follow_number }}</td>
                        <td>{{ props.item.purchase_number }}</td>
                        <td>{{ props.item.type_id ? props.item.type.name : '' }}</td>
                        <td>{{ props.item.sex_id ? props.item.sex.name : '' }}</td>
                        <td>{{ props.item.specie_id ? props.item.specie.name : '' }}</td>
                        <td>{{ props.item.subspecie_id ? props.item.subspecie.name : '' }}</td>
                        <td>{{ props.item.group_id ? props.item.group.name : '' }}</td>
                        <td>{{ props.item.name_id ? props.item.name.name : '' }}</td>
                        <td>{{ props.item.synonym_id ? props.item.synonym.name : '' }}</td>
                        <td>{{ props.item.crossing_id ? props.item.crossing.name : '' }}</td>
                        <td>{{ props.item.winner_id ? props.item.winner.name : '' }}</td>
                        <td>{{ props.item.treetype_id ? props.item.treetype.name : '' }}</td>
                        <td>{{ props.item.priority_id ? props.item.priority.name : '' }}</td>
                        <td>{{ props.item.place }}</td>
                        <td>{{ props.item.latitude }}</td>
                        <td>{{ props.item.longitude }}</td>
                        <td>
                            <v-icon v-if="props.item.replant" class="green--text">check_box</v-icon>
                            <v-icon v-else class="red--text">check_box_outline_blank</v-icon>
                        </td>
                        <td>{{ props.item.moved }}</td>
                        <td>
                            <v-icon v-if="props.item.dead" class="green--text">check_box</v-icon>
                            <v-icon v-else class="red--text">check_box_outline_blank</v-icon>
                        </td>
                        <td>{{ props.item.supplier_id ? props.item.supplier.name : '' }}</td>
                        <td>{{ props.item.planted }}</td>
                        <td>{{ props.item.bloom_colors.map( color => color.name ).join( ', ' ) }}</td>
                        <td>{{ props.item.months.map( month => month.name ).join( ', ' ) }}</td>
                        <td>{{ props.item.macule_colors.map( color => color.name ).join( ', ' ) }}</td>
                        <td>{{ props.item.size_id ? props.item.size.name : '' }}</td>
                        <td>{{ props.item.note }}</td>
                        <td>{{ props.item.description }}</td>
                        <td>
                            <v-icon v-if="props.item.image" class="green--text">check_box</v-icon>
                            <v-icon v-else class="red--text">check_box_outline_blank</v-icon>
                        </td>
                        <td class="justify-center layout px-0">
                            <v-tooltip bottom>
                                <v-btn class="mx-0" slot="activator" icon :to="{ name: 'plantShow', params: { id: props.item.id} }">
                                    <v-icon color="blue">help_outline</v-icon>
                                </v-btn>
                                <span>Plant bekijken</span>
                            </v-tooltip>

                            <v-tooltip bottom>
                                <v-btn class="mx-0" slot="activator" icon @click.native="editItem( props.item )">
                                    <v-icon color="green">edit</v-icon>
                                </v-btn>
                                <span>Plant Bewerken</span>
                            </v-tooltip>

                            <v-tooltip bottom>
                                <v-btn class="mx-0" slot="activator" icon @click="deleteItem = props.item">
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                                <span>plant verwijderen</span>
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
        <v-dialog v-model="Object.keys( deleteItem ).length > 0" width="400px">
            <v-card>
                <v-card-title>
                    <span class="headline">Plant verwijderen</span>
                </v-card-title>

                <v-card-text v-if="deleteItem.name">
                    Weet je zeker dat je de volgende plant wil verwijderen: <strong>{{ deleteItem.name.name }}</strong>?
                </v-card-text>

                <v-card-text v-if="!deleteItem.name">
                    Weet je zeker dat je de plant met het volgnummer <strong>{{ deleteItem.follow_number }} </strong>
                    wilt verwijderen?
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
		data: () => ({
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
                    value: 'type.name'
                },
                {
                    text: 'Geslacht',
                    align: 'left',
                    value: 'sex.name'
                },
                {
                    text: 'Soortnaam',
                    align: 'left',
                    value: 'specie.name'
                },
                {
                    text: 'Variëteitsnaam',
                    align: 'right',
                    value: 'subspecie.name'
                },
                {
                    text: 'Groep',
                    align: 'right',
                    value: 'group.name'
                },
                {
                    text: 'Naam',
                    align: 'right',
                    value: 'name.name'
                },
                {
                    text: 'Synoniem',
                    align: 'right',
                    value: 'synonym.name'
                },
                {
                    text: 'Kruising ouders',
                    align: 'right',
                    value: 'crossing.name'
                },
                {
                    text: 'Winner',
                    align: 'right',
                    value: 'winner.name'
                },
                {
                    text: 'Boomtype',
                    align: 'right',
                    value: 'treetype.name'
                },
                {
                    text: 'Belang',
                    align: 'right',
                    value: 'priority.name'
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
                    value: 'supplier.name'
                },
                {
                    text: 'Poot datum',
                    align: 'right',
                    value: 'planted'
                },
                {
                    text: 'Bloeikleur',
                    align: 'right',
                    value: '',
                    sortable: false
                },
                {
                    text: 'Bloeitijd',
                    align: 'right',
                    value: '',
                    sortable: false
                },
                {
                    text: 'Maculekleur',
                    align: 'right',
                    value: '',
                    sortable: false
                },
                {
                    text: 'Grootte',
                    align: 'right',
                    value: 'size.name'
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
                    text: 'Afbeelding',
                    align: 'right',
                    value: 'image'
                },
                {
                    text: 'Acties',
                    align: 'left',
                    value: '',
                    sortable: false,
                }
            ],
        }),

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

			/**
			 * Calculate the total amount of pages
			 */
			pages()
			{
				if( this.pagination.rowsPerPage == null || this.pagination.totalItems == null )
				{
					return 0;
				}

				return Math.ceil( this.items.length / this.pagination.rowsPerPage );
			},

			types()
			{
				return this.$store.getters.typeIndex;
			},

			sexes()
			{
				return this.$store.getters.sexIndex;
			},

			species()
			{
				return this.$store.getters.specieIndex;
			},

			subspecies()
			{
				return this.$store.getters.subspecieIndex;
			},

			groups()
			{
				return this.$store.getters.groupIndex;
			},

			synonyms()
			{
				return this.$store.getters.synonymIndex;
			},

			crossings()
			{
				return this.$store.getters.crossingIndex;
			},

			winners()
			{
				return this.$store.getters.winnerIndex;
			},

			treetypes()
			{
				return this.$store.getters.treetypeIndex;
			},

			priorities()
			{
				return this.$store.getters.priorityIndex;
			},

			suppliers()
			{
				return this.$store.getters.supplierIndex;
			},

			sizes()
			{
				return this.$store.getters.sizeIndex;
			},

			names()
			{
				return this.$store.getters.nameIndex;
			},

			colors()
			{
				return this.$store.getters.colorIndex;
			},

			months()
			{
				return this.$store.getters.monthIndex;
			}
		},
		methods: {
			delete( item )
			{
				this.deleteItem = item;
			},
			/**
			 * Show context menu
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
				this.loading = true;
				this.$store.dispatch( 'plantIndex', this.pagination ).then( () =>
				{
					this.loading = false;
				} );
			},

			/**
			 * Store/ update item
			 */
			store()
			{
				this.loading = true;

				// Dispatch different function based for store or update
				this.$store.dispatch( this.itemEdit !== null ? 'plantUpdate' : 'plantStore', this.form ).then( () =>
				{
					if( this.errors.length === 0 )
					{
						this.data(); // Refresh data
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
					let newItem = this.selected.item;

					// find data for selected item
					item = newItem;
				}
				this.itemEdit = item.id;
				this.form = Object.assign( this.form, item );
				this.dialog = true; // Open dialog
			},

			/**
			 * Delete item from context menu
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
                        follow_number: newItem.follow_number,
                        name: newItem.name
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
				this.$store.dispatch( 'plantDestroy', id ).then( () =>
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
				this.form = this.defaultForm;
				this.itemEdit = null;
			},

			typeIndex()
			{
				this.$store.dispatch( 'typeIndex' );
			},

			sexIndex()
			{
				this.$store.dispatch( 'sexIndex' );
			},

			specieIndex()
			{
				this.$store.dispatch( 'specieIndex' );
			},

			subspecieIndex()
			{
				this.$store.dispatch( 'subspecieIndex' );
			},

			groupIndex()
			{
				this.$store.dispatch( 'groupIndex' );
			},

			synonymIndex()
			{
				this.$store.dispatch( 'synonymIndex' );
			},

			crossingIndex()
			{
				this.$store.dispatch( 'crossingIndex' );
			},

			winnerIndex()
			{
				this.$store.dispatch( 'winnerIndex' );
			},

			priorityIndex()
			{
				this.$store.dispatch( 'priorityIndex' );
			},

			treetypeIndex()
			{
				this.$store.dispatch( 'treetypeIndex' );
			},

			supplierIndex()
			{
				this.$store.dispatch( 'supplierIndex' );
			},

			sizeIndex()
			{
				this.$store.dispatch( 'sizeIndex' );
			},

			nameIndex()
			{
				this.$store.dispatch( 'nameIndex' );
			},

			colorIndex()
			{
				this.$store.dispatch( 'colorIndex' );
			},

			monthIndex()
			{
				this.$store.dispatch( 'monthIndex' );
			},

			/**
			 * Upload image
			 * @param e
			 */
			getImage( e )
			{
				let image = e.target.files[0];
				const reader = new FileReader();

				reader.readAsDataURL( image );
				reader.onload = e =>
				{
					this.form.image = e.target.result;
				}
			},
		},

		watch: {
			pagination: {
				handler()
				{
					this.data();
				}
			},

            dialog( value )
            {
                if( !value )
                {
                    let props = Object.getOwnPropertyNames(this.form);
                    for( let i = 0; i < props.length; i++ )
                    {
                    	delete this.form[props[i]];
                    }

                    // Reset form
                	this.form = {
						dead: false,
						replant: false,
						bloom_colors: [],
						months: [],
						macule_colors: []
					};

                	this.itemEdit = null;
                }
            },
		},

		mounted()
		{
			this.typeIndex();

			this.sexIndex();

			this.specieIndex();

			this.subspecieIndex();

			this.groupIndex();

			this.synonymIndex();

			this.crossingIndex();

			this.winnerIndex();

			this.priorityIndex();

			this.treetypeIndex();

			this.supplierIndex();

			this.sizeIndex();

			this.nameIndex();

			this.colorIndex();

			this.monthIndex();
		}
	}
</script>
