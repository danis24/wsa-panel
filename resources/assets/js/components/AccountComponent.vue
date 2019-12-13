<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <account-list />
    </div>
    <div class="col-md-4">
      <login />
    </div>
    <div class="col-md-6">
      <deposit />
      <deposit-histories />
    </div>

    <div class="col-md-6">
      <withdraw />
    </div>

  </div>
</div>
</template>

<script>
import Login from './auth/LoginComponent'
import AccountList from './accounts/AccountListComponent'
import Deposit from './accounts/DepositComponent'
import Withdraw from './accounts/WithdrawComponent'
import DepositHistories from './accounts/DepositHistoriesComponent';

export default {
  components: {
    Login,
    Deposit,
    AccountList,
    Withdraw,
    DepositHistories
  }
}
</script>
