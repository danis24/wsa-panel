<template>
  <div class="card card-default">
    <div class="card-header">Withdraw</div>

    <div class="card-body">
      <form action="https://httpbin.org/post" method="post">
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
          <button class="btn btn-pill btn-warning" type="button" @click.prevent="createWithdraw()">
            <i class="fe fe-dollar-sign"></i> Withdraw
          </button>
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
      totp: ""
    };
  },
  methods: {
    createWithdraw() {
      if (this.address == "") {
        let toast = this.$toasted.show("Address Must Be Fill !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      } else {
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
            let toast = this.$toasted.show("Balance Insufficient", {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          } else if (response.data.TooSmall == 1) {
            let toast = this.$toasted.show("Balance Too Small", {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          } else if (response.data.Pending) {
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
