/*
 * All routes under admin/ dashboard are listed here
 */
const adminRoutes = [
	{
		path: '',
		name: 'dashboard',
		meta: {
			title: 'Overzicht'
		},
		component: () => import( '@/pages/admin' )
	},
	{
		path: 'colors',
		name: 'colorIndex',
		meta: {
			title: 'Kleuren',
		},
		component: () => import( '@/pages/admin/color' )
	},
	{
		path: 'crossings',
		name: 'crossingIndex',
		meta: {
			title: 'Kruisingen'
		},
		component: () => import( '@/pages/admin/crossing' )
	},
	{
		path: 'groups',
		name: 'groupIndex',
		meta: {
			title: 'Groepen'
		},
		component: () => import( '@/pages/admin/group' )
	},
	{
		path: 'months',
		name: 'monthIndex',
		meta: {
			title: 'Maanden'
		},
		component: () => import( '@/pages/admin/month' )
	},
	{
		path: 'plants',
		name: 'plantIndex',
		meta: {
			title: 'Planten'
		},
		component: () => import( '@/pages/admin/plant' )
	},

	{
		path: 'plants/print',
		name: 'plantPrint',
		meta: {
			title: 'Planten printen'
		},
		component: () => import( '@/pages/admin/plant/print' )
	},
	{
		path: 'plants/map',
		name: 'plantMap',
		meta: {
			title: 'Planten op de kaart'
		},
		component: () => import( '@/pages/admin/plant/map' )
	},
	{
		path: 'plants/print-qr',
		name: 'plantPrintQR',
		meta: {
			title: 'Print QR-codes'
		},
		component: () => import( '@/pages/admin/plant/qrcode' )
	},
	{
		path: 'plants/:id',
		params: true,
		name: 'plantShow',
		meta: {
			title: 'Plant'
		},
		component: () => import( '@/pages/admin/plant/show' )
	},
	{
		path: 'priorities',
		name: 'priorityIndex',
		meta: {
			title: 'Belangen'
		},
		component: () => import( '@/pages/admin/priority' )
	},
	{
		path: 'sexes',
		name: 'sexIndex',
		meta: {
			title: 'Geslachten'
		},
		component: () => import( '@/pages/admin/sex' )
	},
	{
		path: 'sizes',
		name: 'sizeIndex',
		meta: {
			title: 'Groottes'
		},
		component: () => import( '@/pages/admin/size' )
	},
	{
		path: 'species',
		name: 'specieIndex',
		meta: {
			title: 'Soorten'
		},
		component: () => import( '@/pages/admin/specie' )
	},
	{
		path: 'suppliers',
		name: 'supplierIndex',
		meta: {
			title: 'Leveranciers'
		},
		component: () => import( '@/pages/admin/supplier' )
	},
	{
		path: 'synonyms',
		name: 'synonymIndex',
		meta: {
			title: 'Synoniemen'
		},
		component: () => import( '@/pages/admin/synonym' )
	},
	{
		path: 'treetypes',
		name: 'treetypeIndex',
		meta: {
			title: 'Boom types'
		},
		component: () => import( '@/pages/admin/treetype' )
	},
	{
		path: 'types',
		name: 'typeIndex',
		meta: {
			title: 'Types'
		},
		component: () => import( '@/pages/admin/type' )
	},
	{
		path: 'subspecies',
		name: 'subspecieIndex',
		meta: {
			title: 'Variëteiten'
		},
		component: () => import( '@/pages/admin/subspecie' )
	},
	{
		path: 'winners',
		name: 'winnerIndex',
		meta: {
			title: 'Winners'
		},
		component: () => import( '@/pages/admin/winner' )
	},
	{
		path: 'names',
		name: 'nameIndex',
		meta: {
			title: 'Namen'
		},
		component: () => import( '@/pages/admin/name' )
	},
	{
		path: 'users',
		name: 'userIndex',
		meta: {
			title: 'Gebruikers'
		},
		component: () => import( '@/pages/admin/user' )
	},
	{
		path: 'users/:id',
		name: 'userShow',
		meta: {
			title: 'Profile'
		},
		component: () => import( '@/pages/admin/user/show' )
	},
	{
		path: 'manual',
		name: 'manual',
		meta: {
			title: 'Handleiding'
		},
		component: () => import( '@/pages/admin/manual' )
	},
];

export default adminRoutes;
