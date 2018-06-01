<template>
    <resource
        :headers="headers"
        name="Krusing"
        :form="form"
        controller="crossing"
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
						type: 'text',
						required: true,
					}
				],
				headers: [
					{
						text: 'Kruising',
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
