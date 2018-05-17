const dashboard = () => import('@/pages/admin/index');
const colorIndex = () => import('@/pages/admin/color');
const crossingIndex = () => import('@/pages/admin/crossing');
const groupIndex = () => import('@/pages/admin/group');
const monthIndex = () => import('@/pages/admin/month');
const plantIndex = () => import('@/pages/admin/plant');
const priorityIndex = () => import('@/pages/admin/priority');
const sexIndex = () => import('@/pages/admin/sex');
const sizeIndex = () => import('@/pages/admin/size');
const specieIndex = () => import('@/pages/admin/specie');
const supplierIndex = () => import('@/pages/admin/supplier');
const synonymIndex = () => import('@/pages/admin/synonym');
const treetypeIndex = () => import('@/pages/admin/treetype');
const typeIndex = () => import('@/pages/admin/type');
const varietyIndex = () => import('@/pages/admin/variety');
const winnerIndex = () => import('@/pages/admin/winner');
const nameIndex = () => import('@/pages/admin/name');

const adminRoutes = [
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
		path: 'crossings',
		name: 'crossingIndex',
		meta: {
			title: 'Kruisingen'
		},
		component: crossingIndex
	},
	{
		path: 'groups',
		name: 'groupIndex',
		meta: {
			title: 'Groepen'
		},
		component: groupIndex
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
		path: 'plants',
		name: 'plantIndex',
		meta: {
			title: 'Planten'
		},
		component: plantIndex
	},
	{
		path: 'priorities',
		name: 'priorityIndex',
		meta: {
			title: 'Belangen'
		},
		component: priorityIndex
	},
	{
		path: 'sexes',
		name: 'sexIndex',
		meta: {
			title: 'Geslachten'
		},
		component: sexIndex
	},
	{
		path: 'sizes',
		name: 'sizeIndex',
		meta: {
			title: 'Groottes'
		},
		component: sizeIndex
	},
	{
		path: 'species',
		name: 'specieIndex',
		meta: {
			title: 'Soorten'
		},
		component: specieIndex
	},
	{
		path: 'suppliers',
		name: 'supplierIndex',
		meta: {
			title: 'Leveranciers'
		},
		component: supplierIndex
	},
	{
		path: 'synonyms',
		name: 'synonymIndex',
		meta: {
			title: 'Synoniemen'
		},
		component: synonymIndex
	},
	{
		path: 'treetypes',
		name: 'treetypeIndex',
		meta: {
			title: 'Boom types'
		},
		component: treetypeIndex
	},
	{
		path: 'types',
		name: 'typeIndex',
		meta: {
			title: 'Types'
		},
		component: typeIndex
	},
	{
		path: 'varieties',
		name: 'varietyIndex',
		meta: {
			title: 'Variëteiten'
		},
		component: varietyIndex
	},
	{
		path: 'winners',
		name: 'winnerIndex',
		meta: {
			title: 'Winners'
		},
		component: winnerIndex
	},
	{
		path: 'names',
		name: 'nameIndex',
		meta: {
			title: 'Names'
		},
		component: nameIndex
	}
];

export default adminRoutes;