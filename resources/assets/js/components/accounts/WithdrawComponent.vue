<template>
  <div class="card card-default">
    <div class="card-header">Withdraw</div>

    <div class="card-body">
      <form v-if="withdrawForm == true">
        <div class="form-group">
          <label class="form-label">Address</label>
          <input
            type="text"
            class="form-control"
            name="address"
            placeholder="Address.."
            aria-autocomplete="list"
            v-model="address"
          />
        </div>

        <div class="form-group">
          <label class="form-label">Amount</label>
          <input
            type="number"
            class="form-control"
            name="amount"
            placeholder="Amount.."
            aria-autocomplete="list"
            v-model="amount"
          />
        </div>

        <div class="form-group">
          <label class="form-label">2FA (if enable)</label>
          <input
            type="text"
            class="form-control"
            name="2fa"
            placeholder="2FA.."
            aria-autocomplete="list"
            v-model="totp"
          />
        </div>

        <div class="form-group">
          <button
            class="btn btn-pill btn-primary"
            type="button"
            @click.prevent="withdrawValidate()"
          >
            <i class="fe fe-dollar-sign"></i> Withdraw
          </button>
        </div>
      </form>
      <form v-if="withdrawValidateLayout == true">
        <div class="card rounded border mb-2">
          <div class="card-body p-3">
            <div class="media">
              <i class="mdi mdi-currency-btc icon-sm align-self-center mr-3"></i>
              <div class="media-body">
                <h6 class="mb-1">Address : {{ this.address }}</h6>
              </div>
            </div>
          </div>
        </div>

        <div class="card rounded border mb-2">
          <div class="card-body p-3">
            <div class="media">
              <i class="mdi mdi-currency-usd icon-sm align-self-center mr-3"></i>
              <div class="media-body">
                <h6 class="mb-1">
                  Amount :
                  <b>{{ this.amount }}</b>
                </h6>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <button class="btn btn-pill btn-primary" type="button" @click.prevent="createWithdraw()">
            <i class="fe fe-dollar-sign"></i> OK
          </button>
          <button
            class="btn btn-pill btn-warning"
            type="button"
            @click.prevent="cancelwithdrawValidate()"
          >
            <i class="fe fe-dollar-sign"></i> Cancel
          </button>
        </div>
      </form>

      <form v-if="withdrawNotif == true">
        <div class="card rounded border mb-2">
          <div class="card-body p-3 text-center">
            <i class="mdi mdi-currency-btc icon-sm"></i>
            <p>
              Withdraw
              <b>{{this.amount}}</b> Doge Successed with address
            </p>
            <div class="media">
              <div class="media-body">
                <h6 class="mb-1">{{ this.address }}</h6>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      address: "",
      amount: 0,
      totp: "",
      withdrawForm: true,
      withdrawValidateLayout: false,
      withdrawNotif: false
    };
  },
  mounted() {
    this.withdrawValidateLayout = false;
    if (this.$localStorage.get("withdrawAddress") != null) {
      this.address = this.$localStorage.get("withdrawAddress");
    }
  },
  methods: {
    withdrawValidate: function() {
      if (this.address == "") {
        let toast = this.$toasted.show("Address Must Be Fill !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      } else if (this.amount == 0) {
        let toast = this.$toasted.show("Amount Must Be Fill !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      } else {
        this.withdrawValidateLayout = true;
        this.withdrawForm = false;
      }
    },
    cancelwithdrawValidate() {
      this.withdrawValidateLayout = false;
      this.withdrawForm = true;
    },
    createWithdraw() {
      if (this.address == "") {
        let toast = this.$toasted.show("Address Must Be Fill !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      } else if (this.amount == 0) {
        let toast = this.$toasted.show("Amount Must Be Fill !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      } else {
        let loader = this.$loading.show({
          loader: "dots",
          color: "#5EABED",
          backgroundColor: "#000000"
        });
        const options = {
          url: "https://www.999doge.com/api/web.aspx",
          method: "POST",
          data: {
            a: "Withdraw",
            s: $cookies.get("SessionCookies"),
            Amount: Number.parseInt(this.amount / 0.00000001),
            Address: this.address,
            Totp: this.totp,
            Currency: "doge"
          }
        };
        this.$axios(options).then(response => {
          if (response.data.InsufficientFunds == 1) {
            loader.hide();
            let toast = this.$toasted.show("Balance Insufficient", {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          } else if (response.data.TooSmall == 1) {
            loader.hide();
            let toast = this.$toasted.show("Balance Too Small", {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          } else if (response.data.Pending) {
            loader.hide();
            this.withdrawForm = false;
            this.withdrawValidateLayout = false;
            this.withdrawNotif = true;
            this.$localStorage.set("withdrawAddress", this.address);
            let toast = this.$toasted.show("Withdraw Succesfully :)", {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          }
        });
      }
    }
  }
};
</script>
