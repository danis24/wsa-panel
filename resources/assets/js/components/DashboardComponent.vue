<template>
  <div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body pb-3">
          <h4 class="card-title mb-5">
            <p class="float-left">High Vulnerabilities</p>
            <div class="badge badge-danger badge-fw float-right">High</div>
          </h4>
          <div class="clearfix"></div>
          <div class="d-flex justify-content-between justify-content-lg-start flex-wrap">
            <div class="mr-5 mb-2">
              <h3 class="text-white">{{countAllVuln.high}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body pb-3">
          <h4 class="card-title mb-5">
            <p class="float-left">Medium Vulnerabilities</p>
            <div class="badge badge-warning badge-fw float-right">Medium</div>
          </h4>
          <div class="clearfix"></div>
          <div class="d-flex justify-content-between justify-content-lg-start flex-wrap">
            <div class="mr-5 mb-2">
              <h3 class="text-white">{{countAllVuln.medium}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body pb-3">
          <h4 class="card-title mb-5">
            <p class="float-left">Low Vulnerabilities</p>
            <div class="badge badge-primary badge-fw float-right">Low</div>
          </h4>
          <div class="clearfix"></div>
          <div class="d-flex justify-content-between justify-content-lg-start flex-wrap">
            <div class="mr-5 mb-2">
              <h3 class="text-white">{{countAllVuln.low}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="card-title">Statistic</h6>
          </div>
          <column-chart :data="countAllVuln.chartData"></column-chart>
        </div>
      </div>
    </div>
    <div class="col-lg-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="card-title">World Statistic</h6>
          </div>
          <geo-chart :data="getGeo"></geo-chart>
        </div>
      </div>
    </div>

    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="card-title">Top 5 Vulnerabilities Site</h6>
          </div>
          <div
            class="list d-flex align-items-center border-bottom pb-3"
            v-for="top in countAllVuln.topData"
          >
            <div class="wrapper w-100">
              <p class="mt-2">{{top.scan_url}}</p>
              <small class="text-muted">
                <b>{{top.total_vul}}</b> Vulnerabilities
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {};
  },
  methods: {
    ...mapActions(["countScanner", "fetchGeo"])
  },
  computed: {
    ...mapGetters(["countAllVuln", "getGeo"])
  },
  mounted() {
    this.countScanner();
    this.fetchGeo();
  }
};
</script>