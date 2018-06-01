<template>
        <resource
            :headers="headers"
            name="Kleur"
            :form="form"
            controller="color"
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
				itemEdit: null,
                dialog: false,
				form: [
					{
						label: 'Naam',
						type: 'text',
						required: true,
					}
                ],
				headers: [
					{
						text: 'Kleur',
						align: 'left',
						value: 'name'
					},
					{
						text: 'Bloeikleur',
						align: 'right',
						value: 'bloom_colors_count'
					},
					{
						text: 'Maculekleur',
						align: 'right',
						value: 'macule_colors_count'
					}
				],
                dataset: [
					{
						label: 'Bloeikleur',
						color: '#313D76',
						item: 'bloom_colors_count'
					},
					{
						label: 'Maculekleur',
						color: '#78B856',
						item: 'macule_colors_count'
					}
				]
			}
		},
		methods: {
			close()
			{
				this.dialog = false;
				this.form = {};
				this.itemEdit = null;
			},
		},
	}
</script>
