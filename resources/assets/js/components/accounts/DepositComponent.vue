<template>
<div class="card card-default">
  <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
  <div class="card-header">Deposit</div>

  <div class="card-body">
    <button class="btn btn-pill btn-warning" type="button" @click.prevent="getAddress()"><i class="fe fe-layers"></i> Get Address</button>
  </div>
</div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  data() {
    return {
      depositAddress: '',
      isLoading: false,
      fullPage: false
    }
  },
  components: {
    Loading
  },
  methods: {
    getAddress() {
      this.isLoading = true;
      let uri = "http://localhost:8000/api/v1/deposit?session=" + $cookies.get('SessionCookies');
      this.axios.get(uri).then(response => {
        this.depositAddress = response.data.Address;
        this.isLoading = false;
      });
    }
  }
}
</script>
