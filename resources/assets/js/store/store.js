import Vue from 'vue';
import Vuex from 'vuex';

// Import global getters, setters and mutations
import getters from './getters';
import actions from './actions';
import mutations from './mutations';

// Import modules
import color from './modules/color';
import month from './modules/month';

Vue.use( Vuex );

export const store = new Vuex.Store( {
	strict: false,
	state: {
		currentDate: '',
		success: '',
		message: '',
		errors: []
	},
	getters,
	mutations,
	actions,

	modules: {
		color,
		month,
	}
});