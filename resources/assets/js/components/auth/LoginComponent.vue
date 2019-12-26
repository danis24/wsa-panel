<template>
  <div class="card card-default">
    <div class="card-header">Login/Create Account</div>
    <div class="card-body">
      <form @submit.prevent="actionLogin">
        <div class="form-group">
          <label class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            name="username"
            placeholder="Username.."
            aria-autocomplete="list"
            v-model="login.username"
          />
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            name="password"
            placeholder="Password.."
            aria-autocomplete="list"
            v-model="login.password"
          />
        </div>

        <div class="form-group">
          <label class="form-label">2FA (if enable)</label>
          <input
            type="text"
            class="form-control"
            name="otp"
            placeholder="2FA.."
            aria-autocomplete="list"
            v-model="login.otp"
          />
        </div>

        <div class="row">
          <div class="col">
            <button class="btn btn-pill btn-success" type="submit">
              <i class="fe fe-lock"></i> Login
            </button>
            <button class="btn btn-pill btn-warning" type="button" @click.prevent="actionRegister">
              <i class="fe fe-user"></i> Register
            </button>
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
      login: {}
    };
  },

  components: {
    Loading: this.VueLoading
  },
  mounted() {
    if (JSON.parse(this.$localStorage.get("auth")) != null) {
      this.login = JSON.parse(this.$localStorage.get("auth"));
    }
  },
  methods: {
    actionRegister: function() {
      let basUrl = "http://localhost:8000/api/v1/register";

      let loader = this.$loading.show({
        loader: "dots",
        color: "#5EABED",
        backgroundColor: "#000000"
      });

      this.axios.post(basUrl, this.login).then(response => {
        if (response.data.success != undefined) {
          loader.hide();
          let toast = this.$toasted.show(
            "Register Successed :) Please Login Now !",
            {
              theme: "toasted-primary",
              position: "top-right",
              duration: 500
            }
          );
        }
        if (response.data.UsernameTaken != undefined) {
          loader.hide();
          let toast = this.$toasted.show("Username Already Taken !", {
            theme: "toasted-primary",
            position: "top-right",
            duration: 500
          });
        }
      });
    },

    actionLogin: function() {
      let basUrl = "https://www.999doge.com/api/web.aspx";

      let loader = this.$loading.show({
        loader: "dots",
        color: "#5EABED",
        backgroundColor: "#000000"
      });

      // Set attribute data
      var bodyFormData = new FormData();
      bodyFormData.set("a", "Login");
      bodyFormData.set("Key", "7d02bcaf7a584578b8fc7781bc849422");
      bodyFormData.set("Username", this.login.username);
      bodyFormData.set("Password", this.login.password);

      this.axios.post(basUrl, bodyFormData).then(response => {
        if (response.data.error != undefined) {
          loader.hide();
          let toast = this.$toasted.show(response.data.error, {
            theme: "toasted-primary",
            position: "top-right",
            duration: 500
          });
        }
        if (response.data.LoginInvalid == 1) {
          loader.hide();
          let toast = this.$toasted.show(
            "Username or Password is Incorrect !!",
            {
              theme: "toasted-primary",
              position: "top-right",
              duration: 500
            }
          );
        }
        if (response.data.SessionCookie != undefined) {
          $cookies.set("SessionCookies", response.data.SessionCookie);
          $cookies.set("AccountId", response.data.AccountId);
          this.$localStorage.set("auth", JSON.stringify(this.login));
          loader.hide();

          let toast = this.$toasted.show("Login Success :)", {
            theme: "toasted-primary",
            position: "top-right",
            duration: 500
          });
        }
      });
    }
  }
};
</script>
