import { store } from '@/store/store';

const index = () => import('@/pages/web/index');

const plantIndex = () => import('@/pages/web/plant/index');
const plantShow = () => import('@/pages/web/plant/show');
const login = () => import('@/pages/web/login');

const webRoutes = [
	{
		path: '',
		name: 'index',
		meta: {
			title: 'Home'
		},
		component: index
	},
	{
		path: 'planten',
		name: 'webPlantIndex',
		meta: {
			title: 'Planten'
		},
		component: plantIndex,
	},
	{
		path: 'planten/:id',
		name: 'plantShow',
		meta: {
			title: 'Plant'
		},
		component: plantShow
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
		component: login
	},

];

export default webRoutes;