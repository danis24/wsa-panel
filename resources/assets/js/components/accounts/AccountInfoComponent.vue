<template>
  <div class="card">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="card-header mt-2">
      <h3 class="card-title">Account ID : {{ this.accountId }}</h3>
    </div>
    <div class="card-header">
      <div class="text-left col-sm-6 float-left">
        <h3 class="card-title">Withdraw Histories</h3>
      </div>
      <div class="col-sm-6 float-right text-right">
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
        <table class="table responsive">
          <thead class="card-alert alert alert-primary mb-0">
            <tr>
              <th scope="col">Address</th>
              <th scope="col">Value</th>
              <th scope="col">Fee</th>
              <th scope="col">Requested</th>
              <th scope="col">Status</th>
              <th scope="col">Completed At</th>
            </tr>
          </thead>
          <tbody>
            <tr class="alert alert-success mb-0" v-for="withdraw in withdrawals">
              <td>{{ withdraw.Address }}</td>
              <td>{{ withdraw.Value*0.00000001 }} {{withdraw.Currency}}</td>
              <td>{{ withdraw.Fee*0.00000001 }}</td>
              <td>{{ withdraw.Requested }}</td>
              <td>{{ withdraw.Completed }}</td>
              <td>{{ withdraw.Completed }}</td>
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
      isLoading: true,
      fullPage: false,
      withdrawals: [],
      accountId: ""
    };
  },
  components: {
    Loading
  },
  mounted() {
    this.getWithdrawHistoris();
    this.accountId = $cookies.get("AccountId");
  },
  methods: {
    getWithdrawHistoris: function() {
      let baseUrl = "https://www.999doge.com/api/web.aspx";

      let sessionCookies = $cookies.get("SessionCookies");
      var bodyFormData = new FormData();
      bodyFormData.set("a", "GetWithdrawals");
      bodyFormData.set("s", sessionCookies);
      this.axios.post(baseUrl, bodyFormData).then(response => {
        this.withdrawals = response.data.Withdrawals;
        this.isLoading = false;
      });
    },
    refresh() {
      this.isLoading = true;
      this.getWithdrawHistoris();
    }
  }
};
</script>
