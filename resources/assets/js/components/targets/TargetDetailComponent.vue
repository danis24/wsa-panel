<template>
  <div class="row grid-margin">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          Domain : {{getTargetDetailState.data.attributes.url}}
          <div class="justify-content-between mt-3">
            <p class="text-muted">IP : {{ getTargetDetailState.data.attributes.query }}</p>
            <p
              class="text-muted"
            >Country : {{ getTargetDetailState.data.attributes.country }} ({{getTargetDetailState.data.attributes.countryCode}})</p>
            <p
              class="text-muted"
            >Region : {{getTargetDetailState.data.attributes.regionName}} ({{getTargetDetailState.data.attributes.region}})</p>
            <p
              class="text-muted"
            >City : {{getTargetDetailState.data.attributes.city}}, {{getTargetDetailState.data.attributes.zip}}</p>
            <p class="text-muted">TimeZone : {{ getTargetDetailState.data.attributes.timezone }}</p>
            <p class="text-muted">ISP : {{ getTargetDetailState.data.attributes.isp }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="row">
        <div class="col-sm-6">
          <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
            <div class="card-body">
              <h6 class="font-weight-normal">Total High</h6>
              <h2 class="mb-0">{{countVulnDetail.high}}</h2>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
            <div class="card-body">
              <h6 class="font-weight-normal">Total Medium</h6>
              <h2 class="mb-0">{{countVulnDetail.medium}}</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="card bg-gradient-primary text-white text-center card-shadow-primary mt-3">
        <div class="card-body">
          <h6 class="font-weight-normal">Total Low</h6>
          <h2 class="mb-0">{{countVulnDetail.low}}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card mt-3">
      <div class="card">
        <div class="card-body">
          <button
            type="button"
            class="btn btn-outline-success btn-icon-text float-right"
            @click.prevent="report()"
          >
            <i class="mdi mdi-file-pdf btn-icon-prepend"></i>
            Report
          </button>
          <div class="template-demo">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="pl-0">Vulnerability</th>
                  <th class="text-right">Risk</th>
                </tr>
              </thead>
              <tbody>
                <template v-for="vuln in allVulnLists">
                  <tr
                    @click="toggle(vuln.vuln_id)"
                    :class="{ opened: opened.includes(vuln.vuln_id) }"
                  >
                    <td class="pl-0">{{vuln.name}}</td>
                    <td class="pr-0 text-right">
                      <div
                        class="badge badge-danger badge-pill"
                        v-if="vuln.risk == 'High'"
                      >{{vuln.risk}}</div>
                      <div
                        class="badge badge-warning badge-pill"
                        v-if="vuln.risk == 'Medium'"
                      >{{vuln.risk}}</div>
                      <div
                        class="badge badge-primary badge-pill"
                        v-if="vuln.risk == 'Low'"
                      >{{vuln.risk}}</div>
                    </td>
                  </tr>
                  <tr v-if="opened.includes(vuln.vuln_id)">
                    <td colspan="2">
                      <div class="card">
                        <div class="accordion" id="accordionExample">
                          <div class="card m-b-0">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                <a
                                  data-toggle="collapse"
                                  data-target="#collapseOne"
                                  aria-expanded="true"
                                  aria-controls="collapseOne"
                                  class
                                >
                                  <i class="m-r-5 fa fa-chevron-down" aria-hidden="true"></i>
                                  <span>Description</span>
                                </a>
                              </h5>
                            </div>
                            <div
                              id="collapseOne"
                              class="collapse show"
                              aria-labelledby="headingOne"
                              data-parent="#accordionExample"
                              style
                            >
                              <div class="card-body">
                                <div v-html="vuln.description"></div>
                              </div>
                            </div>
                          </div>
                          <div class="card m-b-0 border-top">
                            <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                <a
                                  class="collapsed"
                                  data-toggle="collapse"
                                  data-target="#collapseTwo"
                                  aria-expanded="false"
                                  aria-controls="collapseTwo"
                                >
                                  <i class="m-r-5 fa fa-chevron-down" aria-hidden="true"></i>
                                  <span>Instance</span>
                                </a>
                              </h5>
                            </div>
                            <div
                              id="collapseTwo"
                              class="collapse"
                              aria-labelledby="headingTwo"
                              data-parent="#accordionExample"
                              style
                            >
                              <div class="card-body">
                                <table class="table table-bordered data-table table-fixed">
                                  <tbody>
                                    <tr v-for="param in vuln.param">
                                      <td>{{param}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="card m-b-0 border-top">
                            <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                <a
                                  class="collapsed"
                                  data-toggle="collapse"
                                  data-target="#collapseThree"
                                  aria-expanded="false"
                                  aria-controls="collapseThree"
                                >
                                  <i class="m-r-5 fa fa-chevron-down" aria-hidden="true"></i>
                                  <span>Solutions</span>
                                </a>
                              </h5>
                            </div>
                            <div
                              id="collapseThree"
                              class="collapse"
                              aria-labelledby="headingThree"
                              data-parent="#accordionExample"
                            >
                              <div class="card-body">
                                <div v-html="vuln.solution"></div>
                              </div>
                            </div>
                          </div>
                          <div class="card m-b-0 border-top">
                            <div class="card-header" id="heading4">
                              <h5 class="mb-0">
                                <a
                                  class="collapsed"
                                  data-toggle="collapse"
                                  data-target="#collapse4"
                                  aria-expanded="false"
                                  aria-controls="collapse4"
                                >
                                  <i class="m-r-5 fa fa-chevron-down" aria-hidden="true"></i>
                                  <span>Reference</span>
                                </a>
                              </h5>
                            </div>
                            <div
                              id="collapse4"
                              class="collapse"
                              aria-labelledby="heading4"
                              data-parent="#accordionExample"
                            >
                              <div class="card-body">
                                <div v-html="vuln.reference"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import { mapActions, mapGetters } from "vuex";
import axios from "axios";
export default {
  data() {
    return {
      isLoading: false,
      fullPage: false,
      opened: []
    };
  },
  components: {
    Loading
  },
  computed: {
    ...mapGetters(["getTargetDetailState", "allVulnLists", "countVulnDetail"])
  },
  methods: {
    ...mapActions(["getTargetDetail", "getVulnList"]),
    report() {
      let url = "/pdf/" + this.$route.params.id;
      window.open(url, "_blank");
    },
    toggle(id) {
      console.log(id);
      const index = this.opened.indexOf(id);
      if (index > -1) {
        this.opened.splice(index, 1);
      } else {
        this.opened.push(id);
      }
    }
  },
  created() {
    this.getTargetDetail(this.$route.params.id);
    this.getVulnList(this.$route.params.id);
  }
};
</script>
<style scoped>
.clear {
  color: white;
  text-decoration: none;
}
.table-hover {
  cursor: pointer;
}
</style>