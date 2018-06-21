import Vue from 'vue';
import Vuetify from 'vuetify';
import { store } from './store/store';
import router from './router';
import Meta from 'vue-meta';

Vue.use( Meta );
Vue.use( Vuetify, {
	theme: {
		primary: '#78B856',
		secondary: '#313D76'
	}
} );


const token = document.head.querySelector( 'meta[name="csrf-token"]' ).getAttribute( 'content' );

if( token )
{
	window.token = token;
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import App from '@/pages/App';

new Vue({
	el: '#app',
	store,
	router,
	render: h => h( App )
});
