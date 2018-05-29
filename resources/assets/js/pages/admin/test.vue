<template>
    <div>
        <!-- Create/ edit dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary">
                <v-icon>add</v-icon>
                Kleur toevoegen
            </v-btn>

            <v-card>
                <form @submit.prevent="store">
                    <v-card-title>
                        <span class="headline">Kleur {{ this.itemEdit !== null ? 'bewerken' : 'toevoegen' }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="form.name" label="Naam" required/>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.native="close">Annuleren</v-btn>
                        <v-btn color="primary" flat type="submit">Kleur {{ this.itemEdit !== null ? 'opslaan' : 'toevoegen' }}</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>

        <data-table
            :headers="headers"
            name="Kleur"
            :form="form"
            controller="color"
        />
    </div>
</template>

<script>
    import dataTable from '@/components/dashboard-table';

	export default
	{
		components: {
			dataTable
        },

		data()
		{
			return {
				itemEdit: null,
                dialog: false,
				form: {},
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
					},
					{
						text: 'Acties',
						align: 'left',
						value: '',
						sortable: false,
					},
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
