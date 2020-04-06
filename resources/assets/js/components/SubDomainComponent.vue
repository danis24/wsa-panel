<template>
  <div class="row grid-margin">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Subdomain Checker</h4>
          <form class="forms-sample">
            <div class="form-group">
              <label for="exampleInputUsername1">Link / Domain</label>
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="www.domain.com"
                  aria-label="www.domain.com"
                  v-model="url"
                />
              </div>
            </div>
            <button
              class="btn btn-primary btn-icon-text justify-content-center"
              v-if="this.buttonLoader == true"
            >
              <fulfilling-bouncing-circle-spinner
                :animation-duration="4000"
                :size="17"
                color="#fff"
              />
            </button>
            <button
              type="button"
              class="btn btn-primary btn-icon-text"
              @click.prevent="clickSubdomain()"
              v-if="this.buttonLoader == false"
            >
              <i class="mdi mdi-content-save-all btn-icon-prepend"></i>
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="alert alert-warning" role="alert">
        <p>* You must input domain without http/https in the field</p>
        <p>* Please input domain or link is active</p>
      </div>
      <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
        <div class="card-body">
          <h6 class="font-weight-normal">Total Subdomain</h6>
          <h2 class="mb-0">{{getSubdomain.length}}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title float-left">Subdomain Lists</h4>
          <div class="float-right">
            <button class="btn btn-warning" @click.prevent="clearDomain()">Clear</button>
            <button class="btn btn-primary">Save</button>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Subdomain</th>
                  <th width="20%">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="subdomain in getSubdomain">
                  <td>
                    <a
                      :href="`http://${subdomain.subdomain}`"
                      target="_blank"
                    >{{subdomain.subdomain}}</a>
                  </td>
                  <td>
                    <label class="badge badge-success" v-if="subdomain.status == 'up'">Domain Aktif</label>
                    <label
                      class="badge badge-danger"
                      v-if="subdomain.status == 'down'"
                    >Domain Tidak Aktif</label>
                  </td>
                </tr>
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
import { FulfillingBouncingCircleSpinner } from "epic-spinners";
import axios from "axios";
export default {
  data() {
    return {
      isLoading: false,
      fullPage: false,
      url: "",
      buttonLoader: false
    };
  },
  components: {
    Loading,
    FulfillingBouncingCircleSpinner
  },
  computed: { ...mapGetters(["getSubdomain"]) },
  methods: {
    ...mapActions(["fetchSubdomain", "clearDomainAction"]),
    async clickSubdomain() {
      this.buttonLoader = true;
      await this.fetchSubdomain({
        url: this.url
      });
      this.buttonLoader = false;
    },
    clearDomain() {
      this.clearDomainAction();
    }
  },
  mounted() {}
};
</script>
<style scoped>
.clear {
  color: white;
  text-decoration: none;
}
</style>