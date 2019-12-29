<template>
  <div>
    <div class="row">
      <div class="col-lg-6 grid-margin">
        <div class="mt-1 alert alert-fill-danger">
          LastRain :
          <br />
          <h4>120</h4>
        </div>
        <div class="card">
          <div class="card-body">
            Balance :
            <br />
            <b>{{ Number.parseFloat(this.balance).toFixed(2) }}</b> Doge
            <div class="float-right">
              <div v-if="this.balanceLoader === true">
                <button class="btn btn-primary btn-rounded btn-icon d-flex justify-content-center">
                  <fulfilling-bouncing-circle-spinner
                    :animation-duration="4000"
                    :size="25"
                    color="#fff"
                  />
                </button>
              </div>
              <div v-if="this.balanceLoader === false">
                <button
                  class="btn btn-primary btn-rounded btn-icon"
                  type="button"
                  @click.prevent="getBalance()"
                >
                  <i class="mdi mdi-reload"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <template v-if="tradeStatus === false">
          <div class="mt-3 alert alert-warning">TRADE STATUS : OFF</div>
        </template>
        <template v-if="tradeStatus === true">
          <div class="mt-3 alert alert-success">TRADE STATUS : RUNNING</div>
        </template>
        <div class="card p-3">
          <h5 class="text-center">Profit Trade</h5>
          <div class="row">
            <div class="col-6">
              <p class="text-center">
                Sessions
                <br />
                {{ Number.parseFloat(this.result.profitSession).toFixed(2) }}
              </p>
            </div>
            <div class="col-6">
              <p class="text-center">
                Global
                <br />
                {{ Number.parseFloat(this.result.profitGlobal).toFixed(2) }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="col-md-12">
          <div class="row mt-1">
            <div class="col-6">
              <div v-if="this.tradeLoader === true">
                <button class="btn btn-primary btn-block d-flex justify-content-center">
                  <fulfilling-bouncing-circle-spinner
                    :animation-duration="4000"
                    :size="17"
                    color="#fff"
                  />
                </button>
              </div>
              <div v-if="this.tradeLoader === false">
                <button class="btn btn-primary btn-block" @click.prevent="startTradding()">Start</button>
              </div>
            </div>
            <div class="col-6">
              <button
                class="btn btn-danger btn-block float-right"
                @click.prevent="stopTradding()"
              >Stop</button>
            </div>
          </div>
        </div>
        <div class="col-md-12 mt-4">
          <div v-if="this.stopOnWinLoader === true">
            <button class="btn btn-warning btn-block d-flex justify-content-center">
              <fulfilling-bouncing-circle-spinner
                :animation-duration="4000"
                :size="18"
                color="#fff"
              />
            </button>
          </div>
          <div v-if="this.stopOnWinLoader === false">
            <button
              class="btn btn-warning btn-block float-right"
              @click.prevent="stopOnWin()"
            >Stop On WIN</button>
          </div>
        </div>
        <div class="col-lg-12 mt-5">
          <br />
          <div class="card">
            <div class="card-body">
              <h4 class="card-title d-inline">Recent Last 50 Transaction</h4>
              <button type="button" class="btn btn-dark btn-rounded btn-icon d-inline float-right">
                <i class="mdi mdi-finance"></i>
              </button>
              <div class="clearfix"></div>
              <div class="table-responsive mt-3">
                <table class="table table-hover">
                  <thead class="card-alert alert alert-primary mb-0" align="center">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Trade</th>
                      <th scope="col">Payout</th>
                      <th scope="col">Profit</th>
                    </tr>
                  </thead>
                  <tbody id="htmlResult"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { FulfillingBouncingCircleSpinner } from "epic-spinners";
import $ from "jquery";
export default {
  data() {
    return {
      balance: "",
      tradeList: [],
      breakTrade: false,
      balanceLoader: false,
      stopOnWinLoader: false,
      tradeLoader: false,
      settings: {},
      tradeStatus: false,
      options: {
        tradeLogic: true,
        delay: 1000,
        highLow: "",
        low: true,
        high: true,
        changePercent: 5,
        low: 0,
        high: 999999,
        basePayIn: 0,
        resetOnWin: 0,
        resetOnLose: 0,
        clientSeed: 0,
        IncreaseOnWinPercent: 0,
        IncreaseOnLosePercent: 0,
        MaxPayIn: 0,
        ResetOnLoseMaxBet: 0,
        StopOnLoseMaxBet: 0,
        StopMinBalance: 0,
        profitTrade: 0,
        countWinStreak: 0,
        countLoseStreak: 0,
        takeProfitGlobal: 0,
        takeProfitSession: 0
      },
      result: {
        isWin: false,
        payOut: 0,
        profit: 0,
        profitSession: 0,
        profitGlobal: 0
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

        var xhr = new XMLHttpRequest();
        var url = "https://www.999doge.com/api/web.aspx";
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function(vm) {
          if (this.readyState === XMLHttpRequest.DONE) {
            let response = JSON.parse(this.responseText);
            let balance = response.Balance * 0.00000001;
            vm.balance = balance;
            vm.balanceLoader = false;
          }
        }.bind(xhr, this);
        xhr.send(bodyFormData);
      }
    },
    async makeTradeRequest() {
      var formBodyData = new FormData();
      formBodyData.set("a", "PlaceAutomatedBets");
      formBodyData.set("s", $cookies.get("SessionCookies"));
      formBodyData.set("BasePayIn", this.options.basePayIn);
      formBodyData.set("Low", this.options.low);
      formBodyData.set("High", this.options.high);
      formBodyData.set("MaxBets", this.settings.tradeCount);
      formBodyData.set("ResetOnWin", this.options.resetOnWin);
      formBodyData.set("ResetOnLose", this.options.resetOnLose);
      formBodyData.set(
        "IncreaseOnWinPercent",
        this.options.IncreaseOnWinPercent
      );
      formBodyData.set(
        "IncreaseOnLosePercent",
        this.options.IncreaseOnLosePercent
      );
      formBodyData.set("MaxPayIn", this.options.MaxPayIn);
      formBodyData.set("ResetOnLoseMaxBet", this.options.ResetOnLoseMaxBet);
      formBodyData.set("StopOnLoseMaxBet", this.options.StopOnLoseMaxBet);
      formBodyData.set("StopMaxBalance", this.options.profitTrade);
      formBodyData.set("StopMinBalance", this.options.StopMinBalance);
      formBodyData.set("ClientSeed", this.options.clientSeed);
      formBodyData.set("Currency", "doge");
      formBodyData.set("ProtocolVersion", 2);

      var xhr = new XMLHttpRequest();
      var url = "https://www.999doge.com/api/web.aspx";
      xhr.open("POST", url, true);
      xhr.onreadystatechange = function(vm) {
        console.log(XMLHttpRequest.DONE);
        if (this.readyState === XMLHttpRequest.DONE) {
          let response = JSON.parse(this.responseText);
          if (response.InsufficientFunds) {
            let htmlResult = "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>Balance Insufficient</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
          } else if (response.TooFast) {
            let htmlResult = "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>To Fast Delay 10 Seconds</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
          } else {
            vm.result.profit =
              response.PayOuts.reduce((a, b) => a + b, 0) +
              response.PayIns.reduce((a, b) => a + b, 0);
            vm.result.payOut = vm.result.profit + vm.options.basePayIn;
            vm.tradeResult();
          }
        }
      }.bind(xhr, this);
      xhr.send(formBodyData);
    },
    async automateBetsParam() {
      if (this.tradeStatus == true) {
        await this.makeTradeRequest();
        await this.delayOnWinLose();
      }
    },
    generateLowHigh(low, high) {
      this.options.low = Math.floor(low);
      this.options.high = Math.floor(high);
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
    delay(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    },
    tradeResult() {
      let trade = this.options.basePayIn * 0.00000001;
      let payOut = this.result.payOut * 0.00000001;
      let profit = this.result.profit * 0.00000001;

      let htmlResult = "";
      if (profit > 0) {
        this.options.countWinStreak += 1;
        this.options.countLoseStreak = 0;
        htmlResult +=
          '<tr class="alert alert-fill-success mb-0" align="center" style="cursor: pointer;">';
        htmlResult += '<th scope="row">' + this.options.highLow + "</th>";
        htmlResult += "<td>" + trade.toFixed(2) + "</td>";
        htmlResult += "<td>" + payOut.toFixed(2) + "</td>";
        htmlResult += "<td>" + profit.toFixed(2) + "</td>";
        htmlResult += "</tr>";
      } else {
        this.options.countLoseStreak += 1;
        this.options.countWinStreak = 0;
        htmlResult +=
          '<tr class="alert alert-fill-danger mb-0" align="center" style="cursor: pointer;">';
        htmlResult += '<th scope="row">' + this.options.highLow + "</th>";
        htmlResult += "<td>" + trade.toFixed(2) + "</td>";
        htmlResult += "<td>" + payOut.toFixed(2) + "</td>";
        htmlResult += "<td>" + profit.toFixed(2) + "</td>";
        htmlResult += "</tr>";
      }

      this.result.profitSession += Number.parseFloat(profit);
      this.result.profitGlobal += Number.parseFloat(profit);
      this.balance += profit;
      $("#htmlResult").prepend(htmlResult);
    },
    tradeLogic() {
      if (this.settings.tradeLogicSelected.selectedValue == 1) {
      }
      if (this.settings.tradeLogicSelected.selectedValue == 2) {
        this.options.tradeLogic = false;
        this.options.highLow = "H";
      }
      if (this.settings.tradeLogicSelected.selectedValue == 3) {
        this.options.tradeLogic = true;
        this.options.highLow = "L";
      }
      if (this.settings.tradeLogicSelected.selectedValue == 4) {
        this.options.tradeLogic = Math.random() >= 0.5;
        if (this.options.tradeLogic == true) {
          this.options.highLow = "L";
        } else {
          this.options.highLow = "H";
        }
      }
    },
    startTradding() {
      $("tbody#htmlResult tr").remove();
      this.tradeStatus = true;
      this.settings = JSON.parse(this.$localStorage.get("configData"));
      this.tradeList = [];
      this.result.profitSession = 0;
      this.result.profitGlobal = 0;
      this.result.payOut = 0;
      this.result.profit = 0;
      this.result.profitSession = 0;
      this.result.profitGlobal = 0;
      this.options.countWinStreak = 0;
      this.options.countLoseStreak = 0;
      this.options.takeProfitGlobal = 0;
      this.options.takeProfitSession = 0;
      this.baseTradeAmount();
      this.sendMessage();
    },
    stopTradding() {
      this.tradeStatus = false;
      this.tradeLoader = false;
    },
    async delayOnWinLose() {
      if (this.result.profit > 0) {
        if (this.settings.delay.onWin < 1) {
          this.options.delay = 200;
        } else {
          this.options.delay = Number.parseInt(
            this.settings.delay.onWin * 1000
          );
        }
      } else {
        if (this.settings.delay.onLose < 1) {
          this.options.delay = 200;
        } else {
          this.options.delay = Number.parseInt(
            this.settings.delay.onLose * 1000
          );
        }
      }
      await this.delay(this.options.delay);
    },
    stopOnWin() {
      this.stopOnWinLoader = true;
      if (this.result.profit > 0) {
        this.stopTradding();
        this.stopOnWinLoader = false;
      }
    },
    async sendMessage() {
      if (this.tradeStatus == true) {
        await this.sendRequest();
        this.sendMessage();
      }
    },
    martingleSingle() {
      if (this.settings.martingleSingle.onWin.status == true) {
        if (this.result.profit > 0) {
          if (
            this.settings.tradeAmount.loseStreak.ifResetRecoverLose == "true"
          ) {
            if (this.settings.baseTradeAmount.usePersentage == true) {
              this.options.basePayIn =
                Math.floor(
                  (this.settings.baseTradeAmount.value * this.balance) / 100
                ) +
                (this.options.basePayIn *
                  this.settings.martingleSingle.onWin.value) /
                  100;
            } else {
              this.options.basePayIn =
                Math.floor(this.settings.baseTradeAmount.value / 0.00000001) +
                (this.options.basePayIn *
                  this.settings.martingleSingle.onWin.value) /
                  100;
            }
          } else {
            this.baseTradeAmount();
          }
        }
      } else {
        this.baseTradeAmount();
      }
      if (this.settings.martingleSingle.onLose.status == true) {
        if (this.result.profit < 0) {
          if (this.settings.baseTradeAmount.usePersentage == true) {
            this.options.basePayIn =
              Math.floor(
                (this.settings.baseTradeAmount.value * this.balance) / 100
              ) +
              (this.options.basePayIn *
                this.settings.martingleSingle.onLose.value) /
                100;
          } else {
            this.options.basePayIn =
              Math.floor(this.settings.baseTradeAmount.value / 0.00000001) +
              (this.options.basePayIn *
                this.settings.martingleSingle.onLose.value) /
                100;
          }
        }
      } else {
        this.baseTradeAmount();
      }
    },
    martingleMulti() {
      //Settings Martingle
      if (this.settings.martingleMulti.sameSingle == false) {
        if (this.settings.martingleMulti.onWin.status == true) {
          this.options.IncreaseOnWinPercent =
            this.settings.martingleMulti.onWin.value / 100;
        }
        if (this.settings.martingleMulti.onLose.status == true) {
          this.options.IncreaseOnLosePercent =
            this.settings.martingleMulti.onLose.value / 100;
        }
      }
      if (this.settings.martingleMulti.sameSingle == true) {
        if (this.settings.martingleSingle.onWin.status == true) {
          this.options.IncreaseOnWinPercent =
            this.settings.martingleSingle.onWin.value / 100;
        }
        if (this.settings.martingleSingle.onLose.status == true) {
          this.options.IncreaseOnLosePercent =
            this.settings.martingleSingle.onLose.value / 100;
        }
      }
    },
    baseTradeAmount() {
      //Setting Percent or not baseTrade value
      if (this.settings.baseTradeAmount.usePersentage == true) {
        let basePersentage =
          (Number.parseFloat(this.settings.baseTradeAmount.value) *
            this.balance) /
          100;
        this.options.basePayIn = Math.floor(basePersentage / 0.00000001);
      } else {
        this.options.basePayIn = Math.floor(
          this.settings.baseTradeAmount.value / 0.00000001
        );
      }
    },
    async takeProfitGlobal() {
      if (this.settings.takeProfitGlobal.profitGlobalValue > 0) {
        let balance = this.balance;
        if (this.settings.takeProfitGlobal.usePersentage == true) {
          this.options.takeProfitGlobal =
            (balance * this.settings.takeProfitGlobal.profitGlobalValue) / 100;
        } else {
          this.options.takeProfitGlobal = this.settings.takeProfitGlobal.profitGlobalValue;
        }
        if (this.settings.takeProfitGlobal.stop == true) {
          if (
            Number.parseFloat(this.result.profitGlobal) >
            Number.parseFloat(this.options.takeProfitGlobal)
          ) {
            this.stopTradding();
            let htmlResult = "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>STOP ON TAKE PROFIT GLOBAL</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
          }
        }
      }
    },
    async takeProfitSession() {
      if (this.settings.takeProfitSession.profitSessionValue > 0) {
        let balance = this.balance;
        if (this.settings.takeProfitSession.usePersentage == true) {
          this.options.takeProfitSession =
            (balance * this.settings.takeProfitSession.profitSessionValue) /
            100;
        } else {
          this.options.takeProfitSession = this.settings.takeProfitSession.profitSessionValue;
        }
        if (
          Number.parseFloat(this.result.profitSession) >
          Number.parseFloat(this.options.takeProfitSession)
        ) {
          let htmlResult = "<tr>";
          htmlResult +=
            "<td colspan='4' align='center'><b>Delay " +
            this.settings.takeProfitSession.delay +
            " Seconds On Take Profit Sessions</b></td>";
          htmlResult += "</tr>";
          $("#htmlResult").prepend(htmlResult);
          this.result.profitSession = 0;
          await this.delay(this.settings.takeProfitSession.delay * 1000);
        }
      }
    },
    async winLoseStreak() {
      let htmlResult = "";
      if (this.settings.tradeAmount.winStreak.status == true) {
        if (
          this.settings.tradeAmount.winStreak.value ==
          this.options.countWinStreak
        ) {
          if (this.settings.tradeAmount.winStreak.onWinStreak == "false") {
            this.options.countWinStreak = 0;
            this.baseTradeAmount();
            htmlResult += "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>Reset On Win Streak. Delay " +
              this.settings.tradeAmount.winStreak.ifResetDelay +
              " Seconds</b></td>";
            htmlResult += "</tr>";
            if (this.settings.tradeAmount.winStreak.ifResetDelay > 0) {
              this.options.delay = Number.parseInt(
                this.settings.tradeAmount.winStreak.ifResetDelay * 1000
              );
            } else {
              this.options.delay = 500;
            }
            $("#htmlResult").prepend(htmlResult);
            await this.delay(this.options.delay);
          } else {
            this.options.countWinStreak = 0;
            this.stopTradding();
            htmlResult += "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>STOP TRADE ON WIN COUNT STREAK</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
          }
        }
      }

      if (this.settings.tradeAmount.loseStreak.status == true) {
        if (
          this.settings.tradeAmount.loseStreak.value ==
          this.options.countLoseStreak
        ) {
          if (this.settings.tradeAmount.loseStreak.onLoseStreak == "false") {
            this.options.countLoseStreak = 0;
            this.baseTradeAmount();
            htmlResult += "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>Reset On Lose Streak. Delay " +
              this.settings.tradeAmount.loseStreak.ifResetDelay +
              " Seconds</b></td>";
            htmlResult += "</tr>";
            if (this.settings.tradeAmount.loseStreak.ifResetDelay > 0) {
              this.options.delay = Number.parseInt(
                this.settings.tradeAmount.loseStreak.ifResetDelay * 1000
              );
            } else {
              this.options.delay = 500;
            }
            $("#htmlResult").prepend(htmlResult);
            await this.delay(this.options.delay);
          } else {
            this.options.countLoseStreak = 0;
            this.stopTradding();
            htmlResult += "<tr>";
            htmlResult +=
              "<td colspan='4' align='center'><b>STOP TRADE ON LOSE COUNT STREAK</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
          }
        }
      }
    },
    async autoWithdraw() {
      if (this.settings.autoWithdraw.status == true) {
        if (this.balance >= this.settings.autoWithdraw.triggeredBalance) {
          let amount = this.balance - this.settings.autoWithdraw.initialBalance;
          var formBodyData = new FormData();
          formBodyData.set("a", "Withdraw");
          formBodyData.set("s", $cookies.get("SessionCookies"));
          formBodyData.set("Amount", Number.parseInt(amount / 0.00000001));
          formBodyData.set(
            "Address",
            this.settings.autoWithdraw.destinationAddress
          );
          formBodyData.set("Totp", "");
          formBodyData.set("Currency", "doge");

          var xhr = new XMLHttpRequest();
          var url = "https://www.999doge.com/api/web.aspx";
          xhr.open("POST", url, true);
          xhr.onreadystatechange = function(vm) {
            if (this.readyState === XMLHttpRequest.DONE) {
              let response = JSON.parse(this.responseText);
              let htmlResult = "<tr>";
              let wdAmount =
                vm.balance - vm.settings.autoWithdraw.initialBalance;
              htmlResult +=
                "<td colspan='4' align='center'><b>Withdraw " +
                wdAmount.toFixed(2) +
                " Doge</b></td>";
              htmlResult += "</tr>";
              $("#htmlResult").prepend(htmlResult);
              vm.balance =
                vm.balance -
                (vm.balance - vm.settings.autoWithdraw.initialBalance);
            }
          }.bind(xhr, this);
          xhr.send(formBodyData);
          await this.delay(1000);
        }
      }
    },
    resetOnWinEvent() {
      //Define resetOnWin true or False
      if (this.settings.tradeAmount.winStreak.onWinStreak == false) {
        this.options.resetOnWin = 1;
      }

      //Define resetOnLose true or False
      if (this.settings.tradeAmount.loseStreak.onLoseStreak == true) {
        this.options.resetOnLose = 1;
      }
    },
    profitTradeAmount() {
      //Trade Amount
      //Profit
      let balance = this.balance / 0.00000001;
      if (this.settings.tradeAmount.profit.mathBaseAmount == true) {
        this.options.profitTrade = Math.floor(
          this.settings.tradeAmount.profit.value * this.options.basePayIn
        );
        this.options.profitTrade = Number.parseInt(
          this.options.profitTrade + balance
        );
      } else {
        this.options.profitTrade = Math.floor(
          this.settings.tradeAmount.profit.value / 0.00000001
        );
        this.options.profitTrade = Number.parseInt(
          this.options.profitTrade + balance
        );
      }
    },
    maxTradeAmountEvent() {
      //Max Trade Amount
      if (this.settings.tradeAmount.maxTradeAmount.mathBaseAmount == true) {
        this.options.MaxPayIn = Math.floor(
          this.settings.tradeAmount.maxTradeAmount.value *
            this.options.basePayIn
        );
      } else {
        this.options.MaxPayIn = Math.floor(
          this.settings.tradeAmount.maxTradeAmount.value / 0.00000001
        );
      }
    },
    ResetOnLoseMaxBetEvent() {
      //Reset OnLose MaxBet
      if (this.settings.tradeAmount.maxTradeAmount.maxTradeOnLose == "false") {
        this.options.ResetOnLoseMaxBet = 1;
      }

      if (this.settings.tradeAmount.maxTradeAmount.maxTradeOnLose == "true") {
        this.options.StopOnLoseMaxBet = 1;
      }
    },
    async sendRequest() {
      this.tradeLoader = true;

      // Generate Seed
      this.generateClientSeed();
      this.getRandomInt(
        this.settings.changeBeetwen.first,
        this.settings.changeBeetwen.last
      );

      // generate change percent high = false or low = true
      this.generatePercent(this.options.changePercent, this.options.tradeLogic);

      this.martingleSingle();

      this.resetOnWinEvent();

      this.martingleMulti();

      this.profitTradeAmount();

      this.maxTradeAmountEvent();

      this.ResetOnLoseMaxBetEvent();

      this.tradeLogic();
      await this.automateBetsParam();
      await this.takeProfitGlobal();
      await this.takeProfitSession();
      await this.winLoseStreak();
      await this.autoWithdraw();
    },
    tradeSingleHistories() {}
  }
};
</script>
