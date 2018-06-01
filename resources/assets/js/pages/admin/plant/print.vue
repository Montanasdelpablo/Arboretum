<template>
    <div>
        <v-btn color="primary" type="button" @click="print">
            <v-icon>print</v-icon>
            Afdrukken
        </v-btn>


        <v-btn flat :to="{ name: 'plantIndex' }">
            <v-icon>arrow_back</v-icon>
            Terug
        </v-btn>

        <img src="@/images/main_logo.png" alt="Arboretum Eenrum" class="logo-img" />

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
                    <td class="text-xs-right">{{ props.item.purchase_number }}</td>
                    <td>
                        {{ props.item.latin_name }}
                    </td>
                    <td>{{ props.item.name ? props.item.name.name : '' }}</td>
                    <td>{{ props.item.place }}</td>
                </tr>
            </template>
        </v-data-table>
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
				headers: [
                    {
                    	text: 'Aankoopnummer',
                        align: 'right',
                        value: 'purchase_number'
                    },
                    {
                    	text: 'Latijnse naam',
                        align: 'left',
                        value: 'latin_name',
                    },
                    {
                    	text: 'Nederlandse naam',
                        align: 'left',
                        value: 'name.name'
                    },
                    {
                    	text: 'Plaats',
                        align: 'left',
                        value: 'place'
                    }
                ]
            }
        },

    	computed: {
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
        },

    	methods: {
    		print()
            {
    		    window.print();
            },
    		plantIndex()
            {
            	this.$store.dispatch( 'plantIndex' );
            }
        },

        mounted()
        {
        	this.plantIndex();
        }
    }
</script>