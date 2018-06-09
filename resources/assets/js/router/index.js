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
		children: webRoutes
	},
	{
		path: '/dashboard',
		component: () => import('@/layouts/admin'),
		props: true,
		meta: {
			title: 'Dashboard',
			auth: true
		},
		children: adminRoutes 
	}
];

const router = new Router({
	mode: 'history',
	routes: routes
});

router.beforeEach( ( to, from, next ) =>
{

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