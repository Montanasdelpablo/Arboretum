import Vue from 'vue';
import { store } from '@/store/store';
import Router from 'vue-router';

import webRoutes from './web';
import adminRoutes from './admin';

// Define constants for layouts first than pages
const web = () => import('@/layouts/web');
const login = () => import('@/pages/web/login');
const register = () => import('@/pages/web/register');

const admin = () => import('@/layouts/admin');

Vue.use( Router );

const routes = [
	{
		path: '/',
		props: true,
		component: web,
		children: webRoutes
	},
	{
		path: '/login',
		props: true,
		meta: {
			title: 'Aanmelden'
		},
		component: web,
		children: [
			{
				path: '',
				name: 'login',
				meta: {
					title: 'Aanmelden'
				},
				component: login
			}
		]
	},
	{
		path: '/register',
		props: true,
		meta: {
			title: 'Registreren'
		},
		component: web,
		children: [
			{
				path: '',
				name: 'register',
				meta: {
					title: 'Registreren'
				},
				component: register
			}
		]
	},
	{
		path: '/dashboard',
		component: admin,
		props: true,
		meta: {
			title: 'Dashboard'
			//auth: true
		},
		children: adminRoutes
	}
];

const router = new Router({
	mode: 'history',
	routes: routes
});
/*
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
});  */

export default router;