<template>
    <resource
        :headers="headers"
        name="Leverancier"
        :form="form"
        controller="supplier"
        :dataset="dataset"
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
						label: 'Naam',
						name: 'name',
						type: 'text',
						required: true,
					},
					{
						label: 'Straat',
						name: 'street',
						type: 'text',
					},
					{
						label: 'Nummer',
						name: 'number',
						type: 'number',
					},
					{
						label: 'Toevoeging',
						name: 'addition',
						type: 'text',
						maxLength: 2,
					},
					{
						label: 'Postcode',
						name: 'zip_code',
						type: 'text',
						maxLength: 6,
						minLength: 6
					},
					{
						label: 'Telefoonnummer',
						name: 'phone_number',
						type: 'string',
						minLength: 10,
						maxLength: 13
					},
					{
						label: 'Website',
						name: 'website',
						type: 'url',
					}
				],
				headers: [
					{
						text: 'Leverancier',
						align: 'left',
						value: 'name'
					},
					{
						text: 'Straat',
						align: 'left',
						value: 'street'
					},
					{
						text: 'Nummer',
						align: 'right',
						value: 'number'
					},
					{
						text: 'Toevoeging',
						align: 'left',
						value: 'addition'
					},
					{
						text: 'Postcode',
						align: 'left',
						value: 'zip_code'
					},
					{
						text: 'Telefoonnummer',
						align: 'right',
						value: 'phone_number'
					},
					{
						text: 'Website',
						align: 'left',
						value: 'website',
						url: true
					},
					{
						text: 'Planten',
						align: 'right',
						value: 'plant_count'
					},
					{
						text: 'Acties',
						align: 'left',
						sortable: false,
					},
				],
				dataset: [
					{
						label: 'Plant',
						color: '#fff',
						item: 'plant_count'
					}
				]
			}
		}
	}
</script>
