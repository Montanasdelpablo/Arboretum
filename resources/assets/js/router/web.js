const index = () => import('@/pages/web/index');

const plantIndex = () => import('@/pages/web/plant/index');
const plantShow = () => import('@/pages/web/plant/show');

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
			title: 'Plant :name'
		},
		component: plantShow
	},
	{
		path: 'locatie',
		name: 'location',
		meta: {
			title: 'Locatie'
		}
	}
];

export default webRoutes;