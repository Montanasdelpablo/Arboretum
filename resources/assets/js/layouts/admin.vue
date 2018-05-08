<template>
    <v-app dark>
        <v-toolbar color="primary">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"/>

            <v-toolbar-title>Titel</v-toolbar-title>

            <v-spacer />

            <v-btn icon><v-icon>search</v-icon></v-btn>
        </v-toolbar>

        <v-navigation-drawer fixed temporary v-model="drawer">
            <v-toolbar flat class="transparent">
                <v-list>
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img src="https://randomuser.me/api/portraits/men/85.jpg" >
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <!--<div v-if="userProfile['first_name'] && userProfile['last_name']">
                                    {{ userProfile['first_name'] }} {{ userProfile['last_name'] }}
                                </div>-->

                                <v-menu>
                                    <v-icon slot="activator">expand_more</v-icon>

                                    <v-list>
                                        <v-list-tile>
                                            <v-list-tile-action>
                                                <v-icon>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-title>
                                               Bewerk profiel
                                            </v-list-tile-title>
                                        </v-list-tile>
                                        <v-list-tile @click.stop="logout">
                                            <v-list-tile-action>
                                                <v-icon>exit_to_app</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-title>Logout</v-list-tile-title>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-toolbar>

            <v-list dense>
                <template v-for="item in items">
                    <v-layout
                        row
                        v-if="item.heading"
                        align-center
                        :key="item.heading"
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
                        </v-flex>

                        <v-flex xs6 class="text-xs-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-flex>
                    </v-layout>

                    <v-list-group v-else-if="item.children" v-model="item.model" :key="item.title" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
                        <v-list-tile slot="activator">
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ item.title }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile
                            v-for="( child, i ) in item.children"
                            :key="i"
                            :to="{ name: child.to }"
                        >
                            <v-list-tile-action>
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

        <v-container fluid>
            <v-alert :type="success ? 'success' : 'error'" :value="message && message.length > 1" transition="scale-transition">
                {{ message }}
            </v-alert>

            <router-view></router-view>
        </v-container>
    </v-app>
</template>

<script>
	export default
	{
		methods: {
			logout()
			{
				this.$store.commit('userLogout');
				this.$router.push( { name: 'index' } );
			}
		},
		data()
		{
			return {
				drawer: false,
				items: [
					{
						title: 'Overview',
						to: 'dashboard',
						icon: 'home'
					},
                    {
                    	title: 'Planten',
                        to: 'plantsIndex',
                        icon: 'filter_vintage'
                    },
                    {
                    	title: 'Kleuren',
                        to: 'colorsIndex',
                        icon: 'colorize'
                    },
                    {
                    	title: 'Kruisingen',
                        to: 'crossingsIndex',
                        icon: 'close'
                    },
                    {
                    	title: 'Groupen',
                        to: 'groupsIndex',
                        icon: 'group_work'
                    },
                    {
                    	title: 'Maanden',
                        to: 'monthsIndex',
                        icon: 'event'
                    },
                    {
                    	title: 'Prioriteit',
                        to: 'prioritiesIndex',
                        icon: 'priority_high'
                    },
                    {
                    	title: 'Geslachten',
                        to: 'sexesIndex',
                        icon: 'wc'
                    },
                    {
                    	title: 'Groottes',
                        to: 'sizesIndex',
                        icon: 'fullscreen'
                    },
                    {
                    	title: 'Soorten',
                        to: 'speciesIndex',
                        icon: ''
                    },
                    {
                    	title: 'Leveranciers',
                        to: 'suppliersIndex',
                        icon: 'local_shipping'
                    },
                    {
                    	title: 'Synoniemen',
                        to: 'synonymsIndex',
                        icon: ''
                    },
                    {
                    	title: 'Boom type',
                        to: 'treetypesIndex',
                        icon: 'nature'
                    },
                    {
                    	title: 'Type',
                        to: 'typesIndex',
                        icon: ''
                    },
                    {
                    	title: 'Variaties',
                        to: 'varietiesIndex',
                        icon: ''
                    },
                    {
                    	title: 'Winners',
                        to: 'winnersIndex',
                        icon: 'cake'
                    }
				]
			}
		}
	}
</script>