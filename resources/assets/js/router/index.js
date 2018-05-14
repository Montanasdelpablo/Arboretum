import Vue from 'vue';
import { store } from '@/store/store';
import Router from 'vue-router';
import size from "@/store/modules/size";

// Define constants for layouts first than pages
const web = () => import('@/layouts/web');
const index = () => import('@/pages/web/index');
const login = () => import('@/pages/web/login');
const register = () => import('@/pages/web/register');

const admin = () => import('@/layouts/admin');
const dashboard = () => import('@/pages/admin/index');

const colorIndex = () => import('@/pages/admin/color');
const monthIndex = () => import('@/pages/admin/month');
const sizeIndex = () => import('@/pages/admin/size');

Vue.use( Router );

const routes = [
	{
		path: '/',
		props: true,
		component: web,
		children: [
			{
				path: '',
				name: 'index',
				meta: {
					title: 'Home'
				},
				component: index
			},
		]
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
		children: [
			{
				path: '',
				name: 'dashboard',
				meta: {
					title: 'Overzicht'
				},
				component: dashboard
			},
			{
				path: 'colors',
				name: 'colorIndex',
				meta: {
					title: 'Kleuren',
				},
				component: colorIndex
			},
			{
				path: 'months',
				name: 'monthIndex',
				meta: {
					title: 'Maanden'
				},
				component: monthIndex
			},
			{
				path: 'sizes',
				name: 'sizeIndex',
				meta: {
					title: 'Groottes'
				},
				component: sizeIndex
			}
		]
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
