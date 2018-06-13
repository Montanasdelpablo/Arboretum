<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs6 md3 v-for="(table, i) in tables" :key="i">
                <v-card :to="{ name: table.to }">
                    <v-card-title class="headline">{{ table.name }}</v-card-title>
                    <v-card-text>{{ count( table.method ) }}</v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
    	data()
        {
    		return {
    		    tables: [
                    {
                    	name: 'Planten',
                        method: 'plants',
                        to: 'plantIndex'
                    },
                    {
                    	name: 'Kleuren',
                        method: 'colors',
						to: 'colorIndex'
                    },
                    {
                    	name: 'Kruisingen',
                        method: 'crossings',
						to: 'crossingIndex'
                    },
                    {
                    	name: 'Groepen',
                        method: 'groups',
						to: 'groupIndex'
                    },
                    {
                    	name: 'Namen',
                        method: 'names',
						to: 'nameIndex'
                    },
                    {
                    	name: 'Belang',
                        method: 'priorities',
						to: 'priorityIndex'
                    },
                    {
                    	name: 'Geslachten',
                        method: 'sexes',
						to: 'sexIndex'
                    },
                    {
                    	name: 'Groottes',
                        method: 'sizes',
						to: 'sizeIndex'
                    },
                    {
                    	name: 'Soorten',
                        method: 'species',
						to: 'specieIndex'
                    },
                    {
                    	name: 'Variëteiten',
                        method: 'subspecies',
						to: 'subspecieIndex'
                    },
                    {
                    	name: 'Leveranciers',
                        method: 'suppliers',
						to: 'supplierIndex'
                    },
					{
                    	name: 'Synoniemen',
                        method: 'synonyms',
						to: 'synonymIndex'
                    },
					{
						name: 'Boomtypes',
						method: 'treetypes',
						to: 'treetypeIndex'
					},
					{
						name: 'Types',
						method: 'types',
						to: 'typeIndex'
					},
					{
						name: 'Winners',
						method: 'winners',
						to: 'winnerIndex'
					}
				]
            }
        },

    	computed: {
    		// Get all required data
    		plants()
            {
                return this.$store.getters.plantIndex;
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
    		// Request all required data
    		plantIndex()
            {
                this.$store.dispatch( 'plantIndex' );
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

            count( method )
            {
            	return this[method].length;
            }
        },

        mounted()
        {
        	// Get all required data
        	this.plantIndex();

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