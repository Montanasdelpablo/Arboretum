<template>
    <v-app dark>
        <!-- Toolbar -->
        <v-toolbar color="primary">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"/>

            <v-toolbar-title>{{ title() }}</v-toolbar-title>

            <v-spacer />
        </v-toolbar>

        <!-- Navigation -->
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

        <!-- Alerts -->
        <v-container fluid>
            <v-alert :type="success ? 'success' : 'error'" :value="message && message.length > 1" transition="scale-transition">
                {{ message }}
            </v-alert>

            <!-- Content -->
            <router-view></router-view>
        </v-container>
    </v-app>
</template>

<script>
	import { mapGetters } from 'vuex';
	export default
	{
		metaInfo() {
			return {
			    title: this.$route.meta.title
            }
        },

        computed: {
			...mapGetters([
				'message',
				'success',
				'errors',
				'userProfile'
			]),
        },

		methods: {
			/**
             * Return the title of the page
             *
			 * @returns {*}
			 */
			title()
			{
                return this.$route.meta.title;
            },

			/**
             * Logout user
			 */
			logout()
			{
				this.$store.commit( 'userLogout' );
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
                        to: 'plantIndex',
                        icon: 'filter_vintage'
                    },
                    {
                    	title: 'Kleuren',
                        to: 'colorIndex',
                        icon: 'colorize'
                    },
                    {
                    	title: 'Kruisingen',
                        to: 'crossingIndex',
                        icon: 'close'
                    },
                    {
                    	title: 'Groepen',
                        to: 'groupIndex',
                        icon: 'group_work'
                    },
                    {
                    	title: 'Maanden',
                        to: 'monthIndex',
                        icon: 'event'
                    },
                    {
                    	title: 'Belang',
                        to: 'priorityIndex',
                        icon: 'priority_high'
                    },
                    {
                    	title: 'Geslachten',
                        to: 'sexIndex',
                        icon: 'wc'
                    },
                    {
                    	title: 'Groottes',
                        to: 'sizeIndex',
                        icon: 'fullscreen'
                    },
                    {
                    	title: 'Soorten',
                        to: 'specieIndex',
                        icon: ''
                    },
                    {
                    	title: 'Leveranciers',
                        to: 'supplierIndex',
                        icon: 'local_shipping'
                    },
                    {
                    	title: 'Synoniemen',
                        to: 'synonymIndex',
                        icon: ''
                    },
                    {
                    	title: 'Boomtype',
                        to: 'treetypeIndex',
                        icon: 'nature'
                    },
                    {
                    	title: 'Type',
                        to: 'typeIndex',
                        icon: ''
                    },
                    {
                    	title: 'Variaties',
                        to: 'subspecieIndex',
                        icon: ''
                    },
                    {
                    	title: 'Winners',
                        to: 'winnerIndex',
                        icon: 'people'
                    },
                    {
                        title: 'Namen',
                        to: 'nameIndex',
                        icon: 'person'
                    },
          					{
          						title: 'Gebruikers',
                      to: 'userIndex',
                      icon: 'person'
          					}
				]
			}
		}
	}
</script>
