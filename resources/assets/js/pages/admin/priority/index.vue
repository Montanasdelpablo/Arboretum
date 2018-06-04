<template>
    <resource
        :headers="headers"
        name="Belang"
        :form="form"
        controller="priority"
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
                    	label: 'Kaart kleur',
                        name: 'color',
                        type: 'color',
                        required: true,
                    }
				],
				headers: [
					{
						text: 'Belang',
						align: 'left',
						value: 'name'
					},
                    {
                    	text: 'Kaart kleur',
                        align: 'left',
                        value: 'color',
                        type: 'color'
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
