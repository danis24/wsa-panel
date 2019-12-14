<template>
<div class="card card-default">
  <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
  <div class="card-header">

    <div class="text-left col-sm-6">
      Deposit Histories
    </div>
    <div class="col-sm-6 text-right">
      <button class="btn btn-pill btn-success" type="button" @click.prevent="refresh()"><i class="fe fe-refresh-cw"></i></button>
    </div>
  </div>

  <div class="card-body o-auto" style="height: 11rem">
    <table class="table">
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
          <td>{{ deposit.Value }} {{ deposit.Currency }}</td>
          <td>{{ deposit.Date }}</td>
          <td>{{ deposit.TransactionHash }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
  data() {
    return {
      deposits: [],
      isLoading: true,
      fullPage: false
    }
  },
  created() {
    this.loadData();
  },
  components: {
    Loading
  },
  methods: {
    loadData() {
      let SessionId = $cookies.get('SessionCookies');
      let uri = 'http://localhost:8000/api/v1/deposit-histories?session=' + SessionId;
      this.axios.get(uri).then(response => {
        this.isLoading = false;
        this.deposits = response.data.Deposits;
      });
    },

    refresh() {
      this.isLoading = true;
      this.loadData();
    }
  }
}
</script>
