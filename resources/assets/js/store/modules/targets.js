import axios from 'axios';

axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*';

const state = {
	targets: [],
	results: [],
	vulnsList: [],
	launch: [],
	countDetailVuln: [],
	targetDetail: [],
	countAllVuln: [],
	getLocations: []
}

const getters = {
	targetResults: (state) => state.results,
	allTargets: (state) => state.targets,
	allVulnLists: (state) => state.vulnsList,
	getLaunch: (state) => state.launch,
	getTargetDetailState: (state) => state.targetDetail,
	countVulnDetail: (state) => state.countDetailVuln,
	countAllVuln: (state) => state.countAllVuln,
	getGeo: (state) => state.getLocations
}

const actions = {
	async fetchGeo({ commit }) {
		const url = "http://localhost:8001/geo";
		const response = await axios.get(url);
		commit("setGeo", response.data);
	},
	async fetchTargets({ commit }) {
		const url = "http://localhost:8001/targets?filter[email]=" + Vue.localStorage.get('email');
		const response = await axios.get(url);
		let targets = response.data;
		let count = targets.data.length;
		let data = {
			meta: {
				total: targets.meta.total,
				count: targets.meta.count,
				total_page: targets.meta.total_page,
			},
			data: []
		};
		for (let i = 0; i < count; i++) {
			let scanner_data = {};
			if (targets.data[i].attributes.launched == 1) {
				const scan_url = "http://localhost:8002/scanners/" + targets.data[i].attributes.scanner_id;
				const scanner = await axios.get(scan_url);
				scanner_data = scanner.data.data.attributes;
			}
			data.data.push({
				id: targets.data[i].id,
				type: targets.data[i].type,
				attributes: targets.data[i].attributes,
				scanner_data: scanner_data
			});
		}
		commit('setTargets', data);
	},

	async countScanner({ commit }) {
		const response = await axios.get('http://localhost:8002/scanners');
		let high = 0;
		let medium = 0;
		let low = 0;
		let topData = [];
		let chartData = [];
		for (let i = 0; i < response.data.length; i++) {
			if (response.data[i].high_vul != null) {
				high = (high + parseInt(response.data[i].high_vul));
			}
			if (response.data[i].medium_vul != null) {
				medium = (medium + parseInt(response.data[i].medium_vul));
			}
			if (response.data[i].low_vul != null) {
				low = (low + parseInt(response.data[i].low_vul));
			}
			if (response.data[i].total_vul != null) {
				chartData.push([response.data[i].scan_url, parseInt(response.data[i].total_vul)]);
				topData.push({
					scan_url: response.data[i].scan_url,
					total_vul: parseInt(response.data[i].total_vul)
				});
			}
		}
		let data = {
			high: high,
			medium: medium,
			low: low,
			topData: Vue.lodash.orderBy(topData, ['total_vul'], ['desc']).slice(0, 5),
			chartData: chartData
		};

		commit("countAllVuln", data);
	},

	async getServerInfo({ commit }, data) {
		const response = await axios.post('http://localhost:8001/getserverinfo', data);
		commit("setResults", response.data);
	},

	async getTargetDetail({ commit }, data) {
		const url = "http://localhost:8001/targets/" + data;
		const response = await axios.get(url);
		commit("setTargetDetail", response.data);
	},

	async getVulnList({ commit }, data) {
		const url = "http://localhost:8002/results/" + data;
		const response = await axios.get(url);
		commit("setVulnsList", response.data);
		commit("countDetailCount", response.data);
	},

	async fetchTargetPaginate({ commit }, id) {
		const url = "http://localhost:8001/targets?filter[email]=" + Vue.localStorage.get('email') + "&page=" + id;
		const response = await axios.get(url);
		let targets = response.data;
		let count = targets.data.length;
		let data = {
			meta: {
				total: targets.meta.total,
				count: targets.meta.count,
				total_page: targets.meta.total_page,
			},
			data: []
		};
		for (let i = 0; i < count; i++) {
			let scanner_data = {};
			if (targets.data[i].attributes.launched == 1) {
				const scan_url = "http://localhost:8002/scanners/" + targets.data[i].attributes.scanner_id;
				const scanner = await axios.get(scan_url);
				scanner_data = scanner.data.data.attributes;
			}
			data.data.push({
				id: targets.data[i].id,
				type: targets.data[i].type,
				attributes: targets.data[i].attributes,
				scanner_data: scanner_data
			});
		}
		console.log(data);
		commit('setTargets', data);
	},

	async syncScanner() {
		const url = "http://localhost:8002/sync-scanner";
		const response = await axios.get(url);
		console.log(response.data);
	},

	async clearVulns({ commit }) {
		commit("clearVulns", []);
	},

	async clearTargets({ commit }) {
		commit("clearTargets", []);
	},

	async launchScanner({ commit }, data) {
		let url = "http://localhost:8002/launch";
		let payload = {
			scan_url: data.scan_url
		}
		const response = await axios.post(url, payload);

		let urlPatch = "http://localhost:8001/launch/" + data.id;
		let patchPayload = {
			scanner_id: response.data.scanid
		}
		const responsePatch = await axios.patch(urlPatch, patchPayload);
		commit("setLaunch", responsePatch.data);
	}
}

const mutations = {
	setGeo: (state, geo) => (state.getLocations = geo),
	setTargets: (state, targets) => (state.targets = targets),
	setVulnsList: (state, vulnsList) => (state.vulnsList = vulnsList),
	setResults: (state, results) => (state.results = results),
	setLaunch: (state, launch) => (state.launch = launch),
	clearTargets: (state, targets) => (state.targets = targets),
	setTargetDetail: (state, targetDetail) => (state.targetDetail = targetDetail),
	countAllVuln: (state, count) => (state.countAllVuln = count),
	countDetailCount: (state, vulns) => {
		let high = 0;
		let medium = 0;
		let low = 0;
		for (let i = 0; i < vulns.length; i++) {
			if (vulns[i].risk == "High") {
				high = high + 1;
			}
			if (vulns[i].risk == "Medium") {
				medium = medium + 1;
			}
			if (vulns[i].risk == "Low") {
				low = low + 1;
			}
		}
		let counts = {
			high: high,
			medium: medium,
			low: low
		}
		state.countDetailVuln = counts;
	}
}

export default {
	state,
	getters,
	actions,
	mutations
}