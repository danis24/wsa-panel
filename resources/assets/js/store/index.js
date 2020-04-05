import Vuex from 'vuex';
import Vue from 'vue';
import Targets from './modules/targets';

//Load Vuex
Vue.use(Vuex);

//Create stores
export default new Vuex.Store({
	modules: {
		Targets
	}
});