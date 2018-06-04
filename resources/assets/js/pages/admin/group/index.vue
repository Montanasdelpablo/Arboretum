<template>
    <resource
        :headers="headers"
        name="Groep"
        :form="form"
        controller="group"
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
						text: 'Groep',
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
