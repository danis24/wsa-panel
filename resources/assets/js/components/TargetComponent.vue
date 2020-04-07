<template>
  <div class="row grid-margin">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Target List</h4>
          <div class="d-flex table-responsive mt-2">
            <div class="btn-group mr-2">
              <router-link to="/target/add" type="button" class="btn btn-primary btn-icon-text">
                <i class="mdi mdi-plus-circle-outline clear"></i>
                Add Domain
              </router-link>
            </div>
            <div class="btn-group mr-2">
              <button class="btn btn-primary btn-icon-text" v-if="this.buttonLoader == true">
                <fulfilling-bouncing-circle-spinner
                  :animation-duration="4000"
                  :size="17"
                  color="#fff"
                />Connecting ..
              </button>
              <button
                type="button"
                class="btn btn-success"
                title="Sync Scanner"
                @click.prevent="reloadPage()"
                v-if="this.buttonLoader == false"
              >
                <i class="mdi mdi-remote"></i>
              </button>
            </div>
            <div class="btn-group ml-auto mr-2 border-0 d-none d-md-block">
              <input type="text" class="form-control" placeholder="Search Here" />
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-light">
                <i class="mdi mdi-dots-vertical"></i>
              </button>
            </div>
          </div>
          <div class="table-responsive">
            <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
            <table class="table mt-3 border-top">
              <thead>
                <tr>
                  <th>IP</th>
                  <th>Domain Address</th>
                  <th>Server Location</th>
                  <th>Status</th>
                  <th>Vulnerabilities</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(target) in allTargets.data" :key="target.id">
                  <td>{{ target.attributes.query }}</td>
                  <td>{{ target.attributes.url }}</td>
                  <td>{{ target.attributes.country}}</td>
                  <td>
                    <div
                      class="badge badge-danger badge-fw"
                      v-if="target.attributes.launched == 0"
                    >Not Scanned</div>
                    <div class="progress progress-lg" v-if="target.attributes.launched == 1">
                      <div
                        class="progress-bar bg-danger"
                        role="progressbar"
                        :style="{'width': `${parseInt(target.scanner_data.vul_status)}%`}"
                        :aria-valuenow="`${parseInt(target.scanner_data.vul_status)}`"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        v-if="parseInt(target.scanner_data.vul_status) >= 0 && parseInt(target.scanner_data.vul_status) < 50"
                      >{{parseInt(target.scanner_data.vul_status)}}%</div>

                      <div
                        class="progress-bar bg-warning"
                        role="progressbar"
                        :style="{'width': `${parseInt(target.scanner_data.vul_status)}%`}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        v-if="parseInt(target.scanner_data.vul_status) >= 50 && parseInt(target.scanner_data.vul_status) < 80"
                      >{{parseInt(target.scanner_data.vul_status)}}%</div>

                      <div
                        class="progress-bar bg-primary"
                        role="progressbar"
                        :style="{'width': `${parseInt(target.scanner_data.vul_status)}%`}"
                        :aria-valuenow="`${parseInt(target.scanner_data.vul_status)}`"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        v-if="parseInt(target.scanner_data.vul_status) >= 80 && parseInt(target.scanner_data.vul_status) <= 100"
                      >{{parseInt(target.scanner_data.vul_status)}}%</div>
                    </div>
                  </td>
                  <td>
                    <div v-if="target.attributes.launched == 0">
                      <div class="badge badge-danger badge-fw">0</div>
                      <div class="badge badge-warning badge-fw">0</div>
                      <div class="badge badge-primary badge-fw">0</div>
                    </div>
                    <div v-if="target.attributes.launched == 1">
                      <div
                        class="badge badge-danger badge-fw"
                        v-if="target.scanner_data.high_vul != null"
                      >{{target.scanner_data.high_vul}}</div>
                      <div
                        v-if="target.scanner_data.high_vul == null"
                        class="badge badge-danger badge-fw"
                      >0</div>

                      <div
                        v-if="target.scanner_data.medium_vul != null"
                        class="badge badge-warning badge-fw"
                      >{{target.scanner_data.medium_vul}}</div>
                      <div
                        v-if="target.scanner_data.medium_vul == null"
                        class="badge badge-warning badge-fw"
                      >0</div>

                      <div
                        v-if="target.scanner_data.low_vul != null"
                        class="badge badge-primary badge-fw"
                      >{{target.scanner_data.low_vul}}</div>
                      <div
                        v-if="target.scanner_data.low_vul == null"
                        class="badge badge-primary badge-fw"
                      >0</div>
                    </div>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-success btn-rounded btn-icon"
                      title="Launch"
                      @click.prevent="startScan(target.id, target.attributes.url)"
                      v-if="target.attributes.launched == 0"
                    >
                      <i class="mdi mdi-play"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-warning btn-rounded btn-icon"
                      title="Pause"
                      v-if="target.attributes.launched == 1"
                    >
                      <i class="mdi mdi-pause"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-primary btn-rounded btn-icon"
                      title="Logs"
                      @click.prevent="detailTarget(target.attributes.scanner_id)"
                      v-if="target.attributes.launched == 1"
                    >
                      <i class="mdi mdi-chart-pie"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="d-flex align-items-center justify-content-between flex-column flex-sm-row mt-4"
          >
            <nav>
              <paginate
                :page-count="allTargets.meta.total_page"
                :page-range="3"
                :margin-pages="2"
                :click-handler="paginate"
                :prev-text="'<'"
                :next-text="'>'"
                :container-class="'pagination pagination-primary mb-0'"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-class="'page-item'"
                :next-class="'page-item'"
                :next-link-class="'page-link'"
                :prev-link-class="'page-link'"
              ></paginate>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Paginate from "vuejs-paginate";
import Loading from "vue-loading-overlay";
import { FulfillingBouncingCircleSpinner } from "epic-spinners";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Targets",
  data() {
    return {
      isLoading: true,
      fullPage: false,
      buttonLoader: false
    };
  },
  components: {
    Paginate,
    Loading,
    FulfillingBouncingCircleSpinner
  },
  methods: {
    ...mapActions([
      "fetchTargets",
      "fetchTargetPaginate",
      "launchScanner",
      "syncScanner",
      "clearTargets"
    ]),
    paginate(pageNum) {
      this.fetchTargetPaginate(pageNum);
    },
    detailTarget(id) {
      let url = "/detail/" + id;
      window.location.href = url;
    },
    delay(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    },
    async reloadPage() {
      this.buttonLoader = true;
      // await this.clearTargets();
      await this.loadPage();
      this.buttonLoader = false;
    },
    async loadPage() {
      await this.syncScanner();
      await this.fetchTargets();
      await this.delay(1000);
      this.isLoading = false;
    },
    async startScan(id, url) {
      let urlScan = "http://" + url;
      let data = {
        id: id,
        scan_url: urlScan
      };
      await this.launchScanner(data);
      await this.fetchTargets();
      await this.syncScanner();
    }
  },
  computed: {
    ...mapGetters(["allTargets"])
  },
  created() {
    this.loadPage();
    window.setInterval(() => {
      this.loadPage();
    }, 10000);
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