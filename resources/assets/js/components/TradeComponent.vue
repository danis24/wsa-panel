<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-6">
        <div class="row">
          <div class="col-12">
            <div class="card p-3">
              <div class="d-flex align-items-center">
                <div class="col-sm-11">
                  <small class="text-muted">
                    <i>LastRain</i>
                  </small>
                  <br />
                  <h4 class="m-0">120</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-alert alert alert-success mb-0">
                Balance :
                <br />
                <b>{{ this.balance*0.00000001 }}</b> Doge
                <div class="float-right">
                  <div v-if="this.balanceLoader === true">
                    <button class="btn btn-pill btn-success d-flex justify-content-center">
                      <fulfilling-bouncing-circle-spinner
                        :animation-duration="4000"
                        :size="25"
                        color="#fff"
                      />
                    </button>
                  </div>
                  <div v-if="this.balanceLoader === false">
                    <button
                      class="btn btn-pill btn-success"
                      type="button"
                      @click.prevent="getBalance()"
                    >
                      <i class="fe fe-refresh-cw"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-alert alert alert-primary mb-0">
                TRADE STATUS :
                <label v-if="tradeStatus === false">OFF</label>
                <label v-if="tradeStatus === true">ON</label>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card p-3">
              <h5 class="text-center">Profit Trade</h5>
              <div class="row">
                <div class="col-6">
                  <p class="text-center">
                    Sessions
                    <br />100
                  </p>
                </div>
                <div class="col-6">
                  <p class="text-center">
                    Global
                    <br />2000
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
                <button class="btn btn-success btn-block d-flex justify-content-center">
                  <fulfilling-bouncing-circle-spinner
                    :animation-duration="4000"
                    :size="25"
                    color="#fff"
                  />
                </button>
              </div>
              <div v-if="this.tradeLoader === false">
                <button class="btn btn-success btn-block" @click.prevent="startTrade()">Start</button>
              </div>
            </div>
            <div class="col-6">
              <button class="btn btn-danger btn-block float-right" @click.prevent="stopTrade()">Stop</button>
            </div>
          </div>
        </div>
        <div class="card p-3">
          <button class="btn btn-warning btn-block float-right">Stop On WIN</button>
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
import { FulfillingBouncingCircleSpinner } from "epic-spinners";
export default {
  data() {
    return {
      balance: "",
      tradeList: [],
      breakTrade: false,
      balanceLoader: false,
      tradeLoader: false,
      isWin: false,
      settings: {},
      tradeStatus: false,
      options: {
        changePercent: 5,
        low: 0,
        high: 999999,
        basePayIn: 0,
        resetOnWin: 0,
        resetOnLose: 0,
        clientSeed: 0
      }
    };
  },
  components: {
    FulfillingBouncingCircleSpinner
  },
  mounted() {
    this.getBalance();
  },
  methods: {
    getBalance() {
      let cookies = $cookies.get("SessionCookies");
      if (cookies === null) {
        let toast = this.$toasted.show(
          "session not found, Please Login Now !",
          {
            theme: "toasted-primary",
            position: "top-right",
            duration: 5000
          }
        );
      } else {
        let baseUrl = "https://www.999doge.com/api/web.aspx";
        this.balanceLoader = true;

        var bodyFormData = new FormData();
        bodyFormData.set("a", "GetBalance");
        bodyFormData.set("s", $cookies.get("SessionCookies"));
        bodyFormData.set("Currency", "doge");
        bodyFormData.set("Referrals", 0);
        bodyFormData.set("Stats", 0);
        this.axios.post(baseUrl, bodyFormData).then(response => {
          this.balance = response.data.Balance;
          this.balanceLoader = false;
        });
      }
    },

    automateBetsParam() {
      var formBodyData = new FormData();
      formBodyData.set("a", "PlaceAutomatedBets");
      formBodyData.set("s", $cookies.get("SessionCookies"));
      formBodyData.set("BasePayIn", this.options.basePayIn);
      formBodyData.set("Low", this.options.low);
      formBodyData.set("High", this.options.high);
      formBodyData.set("MaxBets", this.settings.tradeCount);
      formBodyData.set("ResetOnWin", this.options.resetOnWin);
      formBodyData.set("ResetOnLose", "");
      formBodyData.set("IncreaseOnWinPercent", "");
      formBodyData.set("IncreaseOnLosePercent", "");
      formBodyData.set("MaxPayIn", "");
      formBodyData.set("ResetOnLoseMaxBet", "");
      formBodyData.set("StopOnLoseMaxBet", "");
      formBodyData.set("StopMaxBalance", "");
      formBodyData.set("StopMinBalance", "");
      formBodyData.set("StartingPayIn", "");
      formBodyData.set("Compact", 1);
      formBodyData.set("ClientSeed", this.options.clientSeed);
      formBodyData.set("Currency", "doge");
      formBodyData.set("ProtocolVersion", 2);
    },
    generateLowHigh(low, high) {
      this.options.low = low;
      this.options.high = high;
    },
    generatePercent(percent, lower = true) {
      var RANGE_MIN = 0;
      var RANGE_MAX = 999999;
      var PERCENT_MIN = 5.0;
      var PERCENT_MAX = 95.0;
      if (percent < PERCENT_MIN || PERCENT_MAX > 95) {
        console.log("Percent must be between 5 and 95");
      }
      if (lower) {
        this.generateLowHigh(RANGE_MIN, RANGE_MAX * (percent / 100));
      } else {
        this.generateLowHigh(RANGE_MAX * ((100 - percent) / 100), RANGE_MAX);
      }
    },
    getRandomInt(min, max) {
      min = Math.ceil(min);
      max = Math.floor(max);
      this.options.changePercent =
        Math.floor(Math.random() * (max - min + 1)) + min;
    },
    generateClientSeed() {
      this.options.clientSeed = Math.floor(
        100000000 + Math.random() * 900000000
      );
    },
    startTrade() {
      this.tradeStatus = true;
      this.breakTrade = false;
      this.tradeList = [];
      this.tradeLoader = true;
      var counter = 0;
      this.settings = JSON.parse(this.$localStorage.get("configData"));
      var timer = setInterval(
        function() {
          if (this.breakTrade === true) {
            clearInterval(timer);
          }
          if (this.breakTrade === false) {
            this.tradeList.push({
              win: true,
              hiLo: "H",
              trade: 20,
              payOut: 2000,
              profit: 1800
            });

            this.balance += 1 / 0.00000001;

            // Generate Seed
            this.generateClientSeed();
            this.getRandomInt(
              this.settings.changeBeetwen.first,
              this.settings.changeBeetwen.last
            );

            // generate change percent high = false or low = true
            this.generatePercent(this.options.changePercent, false);

            //Setting Percent or not baseTrade value
            if (this.settings.baseTradeAmount.usePersentage == true) {
              this.basePayIn =
                (this.settings.baseTradeAmount.value * this.balance) / 100;
            } else {
              this.basePayIn = this.settings.baseTradeAmount.value / 0.00000001;
            }

            //Defne resetOnWin true or False
            if (this.settings.tradeAmount.winStreak.onWinStreak == false) {
              this.options.resetOnWin = 1;
            }
            this.isWin = true;
            counter++;
          }
        }.bind(this),
        1000
      );
    },
    stopTrade() {
      this.tradeStatus = false;
      this.tradeLoader = false;
      this.breakTrade = true;
    }
  }
};
</script>
