<template>
  <div class="card card-default">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="card-header">
      <div class="text-left col-sm-6 float-left">Deposit Histories</div>
      <div class="col-sm-6 text-right float-right">
        <button
          class="btn btn-primary btn-rounded btn-icon"
          type="button"
          @click.prevent="refresh()"
        >
          <i class="mdi mdi-reload"></i>
        </button>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="card-alert alert alert-primary mb-0">
            <tr>
              <th scope="col">Address</th>
              <th scope="col">value</th>
              <th scope="col">date</th>
              <th scope="col">transaction hash</th>
            </tr>
          </thead>
          <tbody>
            <tr class="alert alert-success mb-0" v-for="deposit in deposits">
              <td scope="row" width="1%">{{ deposit.Address }}</td>
              <td>{{ deposit.Value*0.00000001 }} {{ deposit.Currency }}</td>
              <td>{{ deposit.Date }}</td>
              <td>{{ deposit.TransactionHash }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      deposits: [],
      isLoading: true,
      fullPage: false
    };
  },
  created() {
    this.loadData();
  },
  components: {
    Loading
  },
  methods: {
    loadData() {
      let SessionId = $cookies.get("SessionCookies");
      let uri = "https://www.999doge.com/api/web.aspx";
      var bodyFormData = new FormData();
      bodyFormData.set("a", "GetDeposits");
      bodyFormData.set("s", SessionId);

      var xhr = new XMLHttpRequest();
      var url = "https://www.999doge.com/api/web.aspx";
      xhr.open("POST", url, true);
      xhr.onreadystatechange = function(vm) {
        if (this.readyState === XMLHttpRequest.DONE) {
          let response = JSON.parse(this.responseText);
          vm.isLoading = false;
          vm.deposits = response.Deposits;
        }
      }.bind(xhr, this);
      xhr.send(bodyFormData);
    },

    refresh() {
      this.isLoading = true;
      this.loadData();
    }
  }
};
</script>
