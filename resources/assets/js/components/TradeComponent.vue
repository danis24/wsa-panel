<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-6">
      <div class="row">
        <div class="col-12">
          <div class="card p-3">
            <div class="d-flex align-items-center">
              <div class="col-sm-11">
                <small class="text-muted">Lastrain</i></small><br>
                <h4 class="m-0">120</h4>
                <small class="text-muted">Last Update: <i>a minutes ago</i></small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-alert alert alert-success mb-0">
              Balance : <br>
              <b>{{ this.balance*0.00000001 }}</b> Doge
              <div class="float-right">
                <div v-if="this.balanceLoader === true">
                  <button class="btn btn-pill btn-success" type="button" id="refreshBalances">
                    <fulfilling-bouncing-circle-spinner :animation-duration="4000" :size="25" color="#fff" /></button>
                </div>
                <div v-if="this.balanceLoader === false">
                  <button class="btn btn-pill btn-success" type="button" @click.prevent="getBalance()"><i class="fe fe-refresh-cw"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-alert alert alert-primary mb-0">
              TRADE STATUS :
              <label v-if="tradeStatus === false">
                OFF
              </label>
              <label v-if="tradeStatus === true">
                ON
              </label>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card p-3">
            <h5 class="text-center">Profit Trade</h5>
            <div class="row">
              <div class="col-6">
                <p class="text-center">
                  Sessions<br>
                  100
                </p>
              </div>
              <div class="col-6">
                <p class="text-center">
                  Global<br>
                  2000
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="card p-3">
        <div class="row">
          <div class="col-6">
            <div v-if="this.tradeLoader === true">
              <button class="btn btn-success btn-block text-center">
                <fulfilling-bouncing-circle-spinner :animation-duration="4000" :size="25" color="#fff" /></button>
            </div>
            <div v-if="this.tradeLoader === false">
              <button class="btn btn-success btn-block" @click.prevent="startTrade()">Start</button>
            </div>
          </div>
          <div class="col-6">
            <button class="btn btn-danger btn-block  float-right" @click.prevent="stopTrade()">Stop</button>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Recent Transaction Last 50</h3>
        </div>
        <div class="card-body o-auto" style="height: 28rem">
          <table class="table">
            <thead class="card-alert alert alert-primary mb-0">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Trade</th>
                <th scope="col">Payout</th>
                <th scope="col">Profit</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="list in tradeList">
                <tr class="alert alert-success mb-0" v-if="isWin === true">
                  <th scope="row">{{ list.hiLo }}</th>
                  <td>{{ list.trade}}</td>
                  <td>{{ list.payOut }}</td>
                  <td>{{ list.profit }}</td>
                </tr>

                <tr class="alert alert-danger mb-0" v-if="isWin === false">
                  <th scope="row">{{ list.hiLo }}</th>
                  <td>{{ list.trade}}</td>
                  <td>{{ list.payOut }}</td>
                  <td>{{ list.profit }}</td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import {
  FulfillingBouncingCircleSpinner
} from 'epic-spinners'
export default {
  data() {
    return {
      balance: '',
      tradeList: [],
      breakTrade: false,
      balanceLoader: false,
      tradeLoader: false,
      isWin: false,
      tradeStatus: false
    }
  },
  components: {
    FulfillingBouncingCircleSpinner
  },
  mounted() {
    this.getBalance();
  },
  methods: {
    getBalance() {
      let cookies =  $cookies.get('SessionCookies');
      if(cookies === null){
        let toast = this.$toasted.show("session not found, Please Login Now !", {
					theme: "toasted-primary",
					position: "top-left",
					duration: 5000
				});
      }else{
				let baseUrl = "http://192.168.1.21/api/v1/balances?session=" + $cookies.get('SessionCookies');
				this.balanceLoader = true;
				this.axios.get(baseUrl).then(response => {
					this.balance = response.data.Balance;
					this.balanceLoader = false;
				});
			}
     
    },

    startTrade() {
      this.tradeStatus = true;
      this.breakTrade = false;
      this.tradeList = [];
      this.tradeLoader = true;
      var counter = 0;
      var timer = setInterval(function () {
        if (this.breakTrade === true) {
          clearInterval(timer);
        }
        if (this.breakTrade === false) {
          console.log("turn no. " + counter);
          this.tradeList.push({
            win: true,
            hiLo: "H",
            trade: 20,
            payOut: 2000,
            profit: 1800
          });
          this.isWin = true;
          console.log(this.isWin);
          console.log(this.tradeList);
          counter++;
        }
      }.bind(this), 1000);
    },
    stopTrade() {
      this.tradeStatus = false;
      this.tradeLoader = false;
      this.breakTrade = true;
    }
  }
}
</script>
