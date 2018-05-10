import Vue from 'vue';
import Vuex from 'vuex';

// Import global getters, setters and mutations
import getters from './getters';
import actions from './actions';
import mutations from './mutations';

// Import modules
import color from './modules/color';
import crossing from './modules/crossing';
import group from './modules/group';
import month from './modules/month';
import plant from './modules/plant';
import priority from './modules/priority';
import sex from './modules/sex';
import size from './modules/size';
import specie from './modules/specie';
import supplier from './modules/supplier';
import synonym from './modules/synonym';
import treetype from './modules/treetype';
import type from './modules/type';
//import user from './modules/user';
import variety from './modules/variety';
import winner from './modules/winner';

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
		crossing,
		group,
		month,
		plant,
		priority,
		sex,
		size,
		specie,
		supplier,
		synonym,
		treetype,
		type,
		//user,
		variety,
		winner,
	}
});