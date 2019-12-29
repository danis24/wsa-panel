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
        var bodyFormData = new FormData();
        bodyFormData.set("a", "Withdraw");
        bodyFormData.set("s", $cookies.get("SessionCookies"));
        bodyFormData.set("Amount", Number.parseInt(this.amount / 0.00000001));
        bodyFormData.set("Address", this.address);
        bodyFormData.set("Totp", this.totp);
        bodyFormData.set("Currency", "doge");

        var xhr = new XMLHttpRequest();
        var url = "https://www.999doge.com/api/web.aspx";
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function(vm) {
          if (this.readyState === XMLHttpRequest.DONE) {
            let response = JSON.parse(this.responseText);
            if (response.InsufficientFunds == 1) {
              let toast = vm.$toasted.show("Balance Insufficient", {
                theme: "toasted-primary",
                position: "top-right",
                duration: 5000
              });
            } else if (response.TooSmall == 1) {
              let toast = vm.$toasted.show("Balance Too Small", {
                theme: "toasted-primary",
                position: "top-right",
                duration: 5000
              });
            } else if (response.Pending) {
              let toast = vm.$toasted.show("Withdraw Succesfully :)", {
                theme: "toasted-primary",
                position: "top-right",
                duration: 5000
              });
            }
          }
        }.bind(xhr, this);
        xhr.send(bodyFormData);
      }
    }
  }
};
</script>
