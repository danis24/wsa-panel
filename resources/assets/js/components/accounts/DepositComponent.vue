<template>
  <div class="card card-default">
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    <div class="card-header">Deposit</div>

    <div class="card-body">
      <div class="row">
        <div class="col-sm-2">
          <button class="btn btn-pill btn-warning" type="button" @click.prevent="getAddress()">
            <i class="fe fe-layers"></i> Get Address
          </button>
        </div>
        <div class="col-sm-8" v-if="depositAddress !== ''">
          Deposit Address : {{ this.depositAddress }}
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <qrcode-vue :value="depositAddress" :size="100" level="M"></qrcode-vue>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import QrcodeVue from "qrcode.vue";

export default {
  data() {
    return {
      depositAddress: "",
      isLoading: false,
      fullPage: false
    };
  },
  components: {
    Loading,
    QrcodeVue
  },
  methods: {
    getAddress() {
      this.isLoading = true;
      let sessionCookies = $cookies.get("SessionCookies");
      let uri = "https://www.999doge.com/api/web.aspx";

      var bodyFormData = new FormData();
      bodyFormData.set("a", "GetDepositAddress");
      bodyFormData.set("s", sessionCookies);
      bodyFormData.set("Currency", "doge");
      this.axios.post(uri, bodyFormData).then(response => {
        this.depositAddress = response.data.Address;
        this.isLoading = false;
      });
    }
  }
};
</script>
