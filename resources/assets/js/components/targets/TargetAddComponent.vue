<template>
  <div class="row grid-margin">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="col-md-6 grid-margin stretch-card" v-if="this.reviewLayout == 0">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Target</h4>
          <p class="card-description float-left">Please Input Your Target List this form</p>
          <div class="float-right">
            <button type="button" class="btn btn-primary btn-rounded btn-icon" @click="addRows">
              <i class="mdi mdi-plus"></i>
            </button>
          </div>
          <div class="clearfix"></div>
          <form class="forms-sample">
            <div class="form-group" v-for="(input, index) in inputs.address" :key="index">
              <label for="exampleInputUsername1">Link / Domain</label>
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="www.domain.com"
                  aria-label="www.domain.com"
                  v-model="input.link"
                />
                <div class="input-group-append">
                  <button
                    type="button"
                    class="btn btn-danger btn-rounded btn-icon"
                    @click="deleteRow(index)"
                  >
                    <i class="mdi mdi-minus"></i>
                  </button>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary btn-icon-text" @click="reviewAdd">
              <i class="mdi mdi-content-save-all btn-icon-prepend"></i>
              Review
            </button>
            <router-link to="/target" type="button" class="btn btn-warning btn-icon-text">
              <i class="mdi mdi-undo btn-icon-prepend"></i>
              Back
            </router-link>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6" v-if="this.reviewLayout == 0">
      <div class="alert alert-warning" role="alert">
        <p>* You must input domain without http/https in the field</p>
        <p>* Please input domain or link is active</p>
        <p>* Click icon (+) for add new row and click (-) for delete rows</p>
      </div>
    </div>
    <div class="col-md-12" v-if="this.reviewLayout == 1">
      <div class="mb-3 float-right">
        <button type="button" class="btn btn-primary btn-icon-text mr-2" @click="saveServerInfo">
          <i class="mdi mdi-content-save-all btn-icon-prepend"></i>
          Save
        </button>
        <button type="button" class="btn btn-warning btn-icon-text" @click="backToReview">
          <i class="mdi mdi-undo btn-icon-prepend"></i>
          Back
        </button>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div
          class="col-6 grid-margin stretch-card"
          v-for="(result, resultId) in targetResults"
          :key="resultId"
        >
          <div class="card">
            <div class="card-body">
              <h4 class="mb-3">Domain : {{ result.domain }}</h4>
              <div
                class="badge badge-danger"
                v-if="result.info.status == 'fail'"
              >Gagal Mendapatkan Informasi Server! Silahkan Ulangi Kembali</div>
              <div class="justify-content-between mt-3" v-if="result.info.status == 'success'">
                <p class="text-muted">IP : {{ result.info.query }}</p>
                <p
                  class="text-muted"
                >Country : {{ result.info.country }} ({{result.info.countryCode}})</p>
                <p class="text-muted">Region : {{result.info.regionName}} ({{result.info.region}})</p>
                <p class="text-muted">City : {{result.info.city}}, {{result.info.zip}}</p>
                <p class="text-muted">TimeZone : {{ result.info.timezone }}</p>
                <p class="text-muted">ISP : {{ result.info.isp }}</p>
                <div
                  class="badge badge-primary"
                  v-if="isSaved[resultId] == '1'"
                >Domain Berhasil Disimpan</div>
                <div
                  class="badge badge-success"
                  v-if="isSaved[resultId] == '2'"
                >Domain Sudah Terdaftar Disistem</div>
                <div class="badge badge-warning" v-if="isSaved[resultId] == '0'">Data Belum Disimpan</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import Paginate from "vuejs-paginate";
import { mapActions, mapGetters } from "vuex";
import axios from "axios";
export default {
  data() {
    return {
      isLoading: false,
      fullPage: false,
      isSaved: [],
      reviewLayout: 0,
      inputs: {
        address: [
          {
            link: ""
          }
        ]
      }
    };
  },
  components: {
    Loading,
    Paginate
  },
  computed: {
    ...mapGetters(["targetResults"])
  },
  methods: {
    ...mapActions(["getServerInfo", "saveServerInfo"]),
    async reviewAdd() {
      this.isLoading = true;
      this.reviewLayout = 1;
      let data = { address: [] };
      for (let i = 0; i < this.inputs.address.length; i++) {
        if (this.inputs.address[i].link != "") {
          this.isSaved.push(0);
          data.address.push({
            link: this.inputs.address[i].link
          });
        }
      }
      const links = JSON.stringify(data);
      await this.getServerInfo(links);
      this.isLoading = false;
    },
    backToReview() {
      this.reviewLayout = 0;
    },
    addRows() {
      this.inputs.address.push({
        link: ""
      });
    },
    delay(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    },
    deleteRow(index) {
      this.inputs.address.splice(index, 1);
    },
    async saveServerInfo() {
      this.isSaved = [];
      this.isLoading = true;
      for (let i = 0; i < this.targetResults.length; i++) {
        let saveTargetValue = {
          email: Vue.localStorage.get("email"),
          url: this.targetResults[i]["domain"],
          country: this.targetResults[i]["info"]["country"],
          countryCode: this.targetResults[i]["info"]["countryCode"],
          region: this.targetResults[i]["info"]["region"],
          regionName: this.targetResults[i]["info"]["regionName"],
          city: this.targetResults[i]["info"]["city"],
          zip: this.targetResults[i]["info"]["zip"],
          latitude: this.targetResults[i]["info"]["lat"],
          longitude: this.targetResults[i]["info"]["lon"],
          timezone: this.targetResults[i]["info"]["timezone"],
          isp: this.targetResults[i]["info"]["isp"],
          org: this.targetResults[i]["info"]["org"],
          as: this.targetResults[i]["info"]["as"],
          query: this.targetResults[i]["info"]["query"]
        };
        const response = await this.axios.post(
          "http://localhost:8001/targets",
          saveTargetValue
        );
        if (response.data.status == "exist") {
          this.isSaved.push(2);
        } else if (response.data.data.id != null) {
          this.isSaved.push(1);
        }
      }
      await this.delay(1000);
      this.isLoading = false;
    }
  }
};
</script>
<style scoped>
.clear {
  color: white;
  text-decoration: none;
}
</style>