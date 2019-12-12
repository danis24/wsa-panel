<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <account-list />
        </div>
        <div class="col-md-4">
            <login-component />
        </div>
        <div class="col-md-6">
            <deposit />
        </div>

        <div class="col-md-6">
            <withdraw />
        </div>

    </div>
</div>
</template>

<script>
import LoginComponent from './auth/LoginComponent'
import AccountList from './accounts/AccountListComponent'
import Deposit from './accounts/DepositComponent'
import Withdraw from './accounts/WithdrawComponent'

export default {
	components: {
		LoginComponent,
		Deposit,
		AccountList,
		Withdraw
	},
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
