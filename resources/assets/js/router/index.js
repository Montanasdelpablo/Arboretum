import Vue from 'vue';
import { store } from '@/store/store';
import Router from 'vue-router';

import webRoutes from './web';
import adminRoutes from './admin';

Vue.use( Router );

const routes = [
	{
		path: '/',
		component: () => import('@/layouts/web'),
		children: webRoutes // All web routes
	},
	{
		path: '/dashboard',
		component: () => import('@/layouts/admin'),
		props: true,
		meta: {
			title: 'Dashboard',
			auth: true // Make sure user is logged in
		},
		children: adminRoutes  // All admin routes
	}
];

const router = new Router({
	mode: 'history',
	routes: routes
});

router.beforeEach( ( to, from, next ) =>
{
	// Check if a user is logged in before continuing
	if( to && to.matched[0] && to.matched[0].meta.auth || to.meta.auth )
	{
		if( store.getters.userLoggedIn )
		{
			next();
		} else {
			next( { name: 'login' } );
		}
	}

	next();
});

export default router;