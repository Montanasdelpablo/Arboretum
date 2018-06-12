<template>
    <v-app>
        <!-- Toolbar -->
        <v-toolbar dark fixed color="primary">
            <v-tooltip bottom>
                <v-toolbar-side-icon @click.stop="drawer = !drawer" slot="activator"/>
                <span>Menu</span>
            </v-tooltip>

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

                        <v-list-tile
                            v-for="(child, i) in item.children"
                            :key="i"
                            :to="{ name: child.to, params: child.params }"
                            :exact="exact( child.to )"
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-tile-action>

                            <v-list-tile-content>
                                <v-list-tile-title>{{ child.title }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>

                    <v-list-tile
                        v-else
                        :key="item.title"
                        :to="{ name: item.to }"
                        :exact="exact( item.to )"
                    >
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
                        to: 'location'
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
			},

			/**
			 * Determine if the route active should be exact
			 *
			 * @param name
			 */
			exact( name )
			{
				let routes = this.flattenArray( this.allRoutes( this.$router.options.routes ) );
				let path = routes.find( e => e.name === name );

				if( path )
				{
					return path.path.slice( -1 ) === '/';
				} else {
					return false;
                }
			},

			/**
			 * Return all routes in array
			 *
			 * @param routes
			 * @param path
			 * @returns {Array}
			 */
			allRoutes( routes, path = '' )
			{
				let router = [];
				routes.map( route => {
					router.push({
						name: route.name,
						path: path + route.path,
					});

					if( route.children )
					{
						router.push(
							this.allRoutes( route.children, route.path + ( path.slice( -1 ) === '/' ? '' : '/' ) )
						);
					}
				});

				return router;
			},

			/**
			 * Flatten multidimensional array
			 * @param array
			 * @returns {*}
			 */
			flattenArray( array )
			{
				return array.reduce( ( acc, val) =>
					Array.isArray( val ) ?
						acc.concat( this.flattenArray( val ) )
						:
						acc.concat( val ), [] );
			},
		}
	}
</script>
