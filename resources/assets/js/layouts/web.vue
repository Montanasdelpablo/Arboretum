<template>
    <v-app>
        <!-- Toolbar -->
        <v-toolbar dark fixed color="primary">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"/>

            <v-toolbar-title>{{ title() }}</v-toolbar-title>

            <v-spacer/>

            <v-toolbar-items>
                <v-tooltip bottom>
                    <v-btn slot="activator" flat :to="{ name: loggedIn ? 'dashboard' : 'login' }">
                        <v-icon v-if="loggedIn">dashboard</v-icon>
                        <v-icon v-else>person</v-icon>
                    </v-btn>

                    <span v-if="loggedIn">Naar dashboard</span>
                    <span v-else>Aanmelden</span>
                </v-tooltip>
            </v-toolbar-items>
        </v-toolbar>

        <!-- Navigation -->
        <v-navigation-drawer fixed temporary v-model="drawer">
            <v-list class="pt-0" dense>
                <template v-for="item in items">
                    <v-layout row v-if="item.heading" align-center :key="item.heading">
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
                        </v-flex>
                    </v-layout>

                    <v-list-group v-else-if="item.children" v-model="item.model" :key="item.title"
                                  :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
                        <v-list-tile slot="activator">
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ item.title }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile v-for="(child, i) in item.children" :key="i"
                                     :to="{ name: child.to, params: child.params }">
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-tile-action>

                            <v-list-tile-content>
                                <v-list-tile-title>{{ child.title }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>

                    <v-list-tile v-else :key="item.title" :to="{ name: item.to }">
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>

        <div class="filler" style="margin-top:64px; width: 100%" />

        <!-- Content -->
        <router-view></router-view>
    </v-app>
</template>

<script>
	export default {
		metaInfo()
		{
			return {
				title: this.title()
			}
		},

		data()
		{
			return {
				drawer: false,
				items: [
					{
						title: 'Home',
						icon: 'home',
						to: 'index'
					},
					{
						title: 'Planten',
						icon: 'filter_vintage',
						to: 'webPlantIndex'
					},
                    {
                        title: 'In de buurt',
                        icon: 'explore',
                        to: ''
                    },
                    {
                    	title: this.loggedIn ? 'Dashboard' : 'Aanmelden',
                        icon: this.loggedIn ? 'dashboard' : 'person',
                        to: 'login'
                    }
				]
			}
		},

        computed: {
			loggedIn()
            {
            	return this.$store.getters.userLoggedIn;
            }
        },

		methods: {
			/**
			 * Return page title
			 */
			title()
			{
				return `${this.$route.meta.title} | Arboretum Eenrum`;
			}
		}
	}
</script>
