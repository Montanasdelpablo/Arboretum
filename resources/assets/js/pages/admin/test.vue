<template>
        <resource
            :headers="headers"
            name="Plant"
            :form="form"
            controller="plant"
            :defaultForm="defaultForm"
        />
</template>

<script>
    import resource from '@/components/resource';

	export default
	{
		components: {
			resource
        },

		data()
		{
			return {
				form: [
					{
						label: 'Volgnummer',
						name: 'follow_number',
                        type: 'number',
					},
					{
						label: 'Aankoopnummer',
						name: 'purchase_number',
						type: 'number',
					},
					{
						label: 'Bloemtype',
						name: 'type_id',
                        type: 'select'
					},
					{
						label: 'Geslacht',
						name: 'sex_id',
                        type: 'select'
					},
					{
						label: 'Soortnaam',
						name: 'specie_id',
                        type: 'select'
					},
					{
						label: 'Variëteitsnaam',
						name: 'subspecie_id',
                        type: 'select'
					},
					{
						label: 'Groep',
						name: 'group_id',
                        type: 'select'
					},
					{
						label: 'Naam',
						name: 'name_id',
                        type: 'select'
					},
					{
						label: 'Synoniem',
						name: 'synonym_id',
                        type: 'select'
					},
					{
						label: 'Kruising ouders',
						name: 'crossing_id',
                        type: 'select'
					},
					{
						label: 'Winner',
						name: 'winner_id',
                        type: 'select'
					},
					{
						label: 'Boomtype',
						name: 'treetype_id',
                        type: 'select'
					},
					{
						label: 'Belang',
						name: 'priority_id',
                        type: 'select'
					},
					{
						label: 'Plaats',
						name: 'place',
						type: 'text',
					},
					{
						label: 'Latitude',
						name: 'latitude',
						type: 'text'
					},
					{
						label: 'Longitude',
						name: 'longitude',
						type: 'text'
					},
					{
						label: 'Herplant',
						name: 'replant',
						type: 'checkbox'
					},
					{
						label: 'Verplaatst',
						name: 'moved'
					},
					{
						label: 'Dood',
						name: 'dead',
						type: 'checkbox'
					},
					{
						label: 'Leverancier',
						name: 'supplier_id',
                        type: 'select'
					},
					{
						label: 'Poot datum',
						name: 'planted'
					},
					{
						label: 'Bloeikleur',
						name: 'bloom_colors',
					},
					{
						label: 'Bloeitijd',
						name: 'bloom_months',
					},
					{
						label: 'Maculekleur',
						name: 'macule_colors',
					},
					{
						label: 'Grootte',
						name: 'size_id',
                        type: 'select'
					},

					{
						label: 'Aantekening',
						name: 'note'
					},
					{
						label: 'Beschrijving',
						name: 'description'
					},
                ],
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
						value: 'replant',
                        boolean: true,
					},
					{
						text: 'Verplaatst',
						align: 'right',
						value: 'moved'
					},
					{
						text: 'Dood',
						align: 'right',
						value: 'dead',
                        boolean: true
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
						value: 'bloom_colors',
                        sortable: false,
					},
					{
						text: 'Bloeitijd',
						align: 'right',
						value: 'months',
                        sortable: false,
					},
					{
						text: 'Maculekleur',
						align: 'right',
						value: 'macule_colors',
                        sortable: false,
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
						text: 'Acties',
						align: 'left',
						value: '',
					}
				],
                dataset: [
					{
						label: 'Plant',
						color: '#fff',
						item: 'plant_count'
					}
				],
				defaultForm: {
					dead: false,
					replant: false,
					image: null,
					bloom_colors: [],
					months: [],
					macule_colors: []
				}
			}
		}
	}
</script>
