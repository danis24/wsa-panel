<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="mt-2">
          <login />
        </div>
      </div>
      <div class="col-md-8">
        <div class="mt-2">
          <withdraw />
        </div>
      </div>
      <div class="col-md-12">
        <div class="mt-4">
          <deposit />
        </div>
        <div class="mt-4">
          <deposit-histories />
        </div>
      </div>

      <div class="col-md-12">
        <div class="mt-4">
          <account-info />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Login from "./auth/LoginComponent";
import AccountInfo from "./accounts/AccountInfoComponent";
import Deposit from "./accounts/DepositComponent";
import Withdraw from "./accounts/WithdrawComponent";
import DepositHistories from "./accounts/DepositHistoriesComponent";

export default {
  components: {
    Login,
    Deposit,
    AccountInfo,
    Withdraw,
    DepositHistories
  }
};
</script>
