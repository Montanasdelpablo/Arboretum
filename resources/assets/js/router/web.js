import { store } from '@/store/store';

const webRoutes = [
	{
		path: '',
		name: 'index',
		meta: {
			title: 'Home'
		},
		component: () => import('@/pages/web/index')
	},
	{
		path: 'planten',
		name: 'webPlantIndex',
		meta: {
			title: 'Planten'
		},
		component: () => import('@/pages/web/plant'),
	},
	{
		path: 'planten/:id',
		name: 'plantShow',
		meta: {
			title: 'Plant'
		},
		component: () => import('@/pages/web/plant/show')
	},
	{
		path: 'planten/print',
		name: 'webPlantPrint',
		meta: {
			title: 'Planten afdrukken'
		},
		component: () => import('@/pages/web/plant/print')
	},
	{
		path: 'locatie',
		name: 'location',
		meta: {
			title: 'Locatie'
		}
	},
	{
		path: 'login',
		name: 'login',
		meta: {
			title: 'Aanmelden'
		},
		beforeEnter: ( to, form, next ) => {
			// If user is logged in return to dashboard
			if( store.getters.userLoggedIn )
			{
				next( { name: 'dashboard' } )
			} else {
				next();
			}
		},
		component: () => import('@/pages/web/login')
	},

];

export default webRoutes;