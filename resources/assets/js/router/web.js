const index = () => import('@/pages/web/index');

const webRoutes = [
	{
		path: '',
		name: 'index',
		meta: {
			title: 'Home'
		},
		component: index
	}
];

export default webRoutes;