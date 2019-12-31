<template>
  <div>
    <div class="row">
      <div class="col-lg-6 grid-margin">
        <div class="card mt-1 alert alert-fill-danger" style="height: 5rem;">
          <div class="card-body" style="padding: 0.88rem 0.81rem;">
            <div class="float-left">
              LastRain :
              <br />
              <h4>{{ this.lastRain }}</h4>
            </div>
            <div class="float-right">
              <div v-if="this.lastRainReload === true">
                <button class="btn btn-primary btn-rounded btn-icon d-flex justify-content-center">
                  <fulfilling-bouncing-circle-spinner
                    :animation-duration="4000"
                    :size="25"
                    color="#fff"
                  />
                </button>
              </div>
              <div v-if="this.lastRainReload === false">
                <button
                  class="btn btn-warning btn-rounded btn-icon d-flex justify-content-center"
                  type="button"
                  @click.prevent="getLastRain()"
                >
                  <i class="mdi mdi-reload" style="margin-right: 0.1rem;"></i>
                </button>
              </div>
            </div>
          </div>
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
      <div class="col-lg-6 grid-margin">
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
        <div class="col-md-12 mt-4 mb-2">
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
              :disabled="this.tradeStatus == false"
            >Stop On WIN</button>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="card mt-4">
          <div class="card-body">
            <p class="float-left">Recent Last 50 Transaction</p>
            <button
              type="button"
              class="btn btn-dark btn-rounded btn-icon d-inline float-right"
              data-toggle="modal"
              data-target="#saveAsModal"
            >
              <i class="mdi mdi-finance"></i>
            </button>
            <div class="clearfix"></div>
            <div class="table-responsive mt-3">
              <table class="table table-hover">
                <thead class="alert alert-fill-primary mb-0" align="center">
                  <tr>
                    <td scope="col">#</td>
                    <td scope="col">Trade</td>
                    <td scope="col">Payout</td>
                    <td scope="col">Profit</td>
                  </tr>
                </thead>
                <tbody id="htmlResult"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="saveAsModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="saveAsModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        role="document"
        style="opacity:0.7 !important; margin-top: 11px;"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="saveAsModalLabel">Trade Analitycs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <area-chart :data="chartData"></area-chart>
              </div>
              <div class="col-md-6 mt-4">
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
                        <button
                          class="btn btn-primary btn-block"
                          @click.prevent="startTradding()"
                        >Start</button>
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
                <table class="table mt-4">
                  <tr>
                    <td width="50%">Balance</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ Number.parseFloat(this.balance).toFixed(2) }}</b>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%">Profit Trade</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ Number.parseFloat(this.result.profitGlobal).toFixed(2) }}</b>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%">Max Win Streak</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ this.result.maxWinStreak }}</b>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%">Max Lose Streak</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ this.result.maxLoseStreak }}</b>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%">Max Trade Win</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ Number.parseFloat(this.result.maxTradeWin).toFixed(2) }}</b>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%">Max Trade Lose</td>
                    <td width="2%">:</td>
                    <td>
                      <b>{{ Number.parseFloat(this.result.maxTradeLose).toFixed(2) }}</b>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      chartData: [],
      balance: "",
      tradeList: [],
      lastRainReload: false,
      breakTrade: false,
      balanceLoader: false,
      stopOnWinLoader: false,
      tradeLoader: false,
      settings: {},
      tradeStatus: false,
      lastRain: 0,
      tradeLogicHiLo: {
        onWin: 1,
        onLose: 1
      },
      options: {
        tradeLogic: true,
        delay: 1000,
        highLow: "L",
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
        profitGlobal: 0,
        tradeSingleHistoriesValue: [],
        tradeListCount: 0,
        maxWinStreak: 0,
        maxLoseStreak: 0,
        maxTradeWin: 0,
        maxTradeLose: 0,
        tradeResponse: []
      },
      temp: {
        maxWinStreak: 0,
        maxLoseStreak: 0
      }
    };
  },
  components: {
    FulfillingBouncingCircleSpinner
  },
  mounted() {
    this.getBalance();
    this.sendWebSocket();
  },
  methods: {
    async sendWebSocket() {
      await this.connect();
      await this.delay(20000);
      this.sendWebSocket();
    },
    getLastRain() {
      this.lastRainReload = true;
      this.connect();
    },
    async connect() {
      this.socket = new WebSocket(
        "wss://www.999doge.com/signalr/connect?transport=webSockets&clientProtocol=1.5&connectionToken=V6%2FKDHAthb9O46r4f1cQonMbzkRDpi69q%2BD7if80pScGTqfP2640sQzsyi8YO4mpZybAvkFciuuEbi4yj0GXnnGLE6MmKV8PdrsaLo85QoW3vsZjbVVPlxC%2FdkfKyrLX&connectionData=%5B%7B%22name%22%3A%22mainhub%22%7D%5D&tid=5"
      );
      this.socket.onopen = () => {
        this.lastRainReload = false;
        this.socket.send(
          JSON.stringify({
            H: "mainhub",
            M: "GetStartupInfo",
            A: [true],
            I: 0
          })
        );
        this.socket.onmessage = ({ data }) => {
          let response = JSON.parse(data);
          if (response.R) {
            if (response.R.site.lastRain != undefined) {
              this.lastRain = response.R.site.lastRain;
            }
          }
        };
      };
    },
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
        this.balanceLoader = true;

        const options = {
          url: "https://www.999doge.com/api/web.aspx",
          method: "POST",
          data: {
            a: "GetBalance",
            s: $cookies.get("SessionCookies"),
            Currency: "doge",
            Stats: 0
          }
        };
        this.$axios(options).then(response => {
          if (response.data.error) {
            let toast = this.$toasted.show(response.data.error, {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          } else {
            let balance = response.data.Balance * 0.00000001;
            this.balance = balance;
            this.balanceLoader = false;
          }
        });
      }
    },
    async makeTradeRequest() {
      let winPercent = this.options.IncreaseOnWinPercent / 100;
      winPercent = winPercent.toFixed(2);
      let losePercent = this.options.IncreaseOnLosePercent / 100;
      losePercent = losePercent.toFixed(2);
      let data = new FormData();
      data.set("a", "PlaceAutomatedBets");
      data.set("s", $cookies.get("SessionCookies"));
      data.set("BasePayIn", this.options.basePayIn);
      data.set("Low", this.options.low);
      data.set("High", this.options.high);
      data.set("MaxBets", this.settings.tradeCount);
      data.set("ResetOnWin", this.options.resetOnWin);
      data.set("ResetOnLose", this.options.resetOnLose);
      data.set("IncreaseOnWinPercent", Number.parseFloat(winPercent));
      data.set("IncreaseOnLosePercent", Number.parseFloat(losePercent));
      data.set("MaxPayIn", this.options.MaxPayIn);
      data.set("ResetOnLoseMaxBet", this.options.ResetOnLoseMaxBet);
      data.set("StopOnLoseMaxBet", this.options.StopOnLoseMaxBet);
      data.set("StopMaxBalance", this.options.profitTrade);
      data.set("StopMinBalance", this.options.StopMinBalance);
      data.set("ClientSeed", this.options.clientSeed);
      data.set("Currency", "doge");
      data.set("ProtocolVersion", 2);
      data.set("Compact", 0);
      const options = {
        url: "https://www.999doge.com/api/web.aspx",
        method: "POST",
        headers: {
          "accept-language": "en-US"
        },
        data: {
          a: "PlaceAutomatedBets",
          s: $cookies.get("SessionCookies"),
          BasePayIn: this.options.basePayIn,
          Low: this.options.low,
          High: this.options.high,
          MaxBets: this.settings.tradeCount,
          ResetOnWin: this.options.resetOnWin,
          ResetOnLose: this.options.resetOnLose,
          IncreaseOnWinPercent: Number.parseFloat(winPercent),
          IncreaseOnLosePercent: Number.parseFloat(losePercent),
          MaxPayIn: this.options.MaxPayIn,
          ResetOnLoseMaxBet: this.options.ResetOnLoseMaxBet,
          StopOnLoseMaxBet: this.options.StopOnLoseMaxBet,
          StopMaxBalance: this.options.profitTrade,
          StopMinBalance: this.options.StopMinBalance,
          ClientSeed: this.options.clientSeed,
          Currency: "doge",
          ProtocolVersion: 2,
          Compact: 0
        }
      };

      this.$axios(options).then(response => {
        if (response.data.InsufficientFunds) {
          let htmlResult = "<tr>";
          htmlResult +=
            "<td colspan='4' align='center'><b>Balance Insufficient</b></td>";
          htmlResult += "</tr>";
          $("#htmlResult").prepend(htmlResult);
        } else if (response.data.TooFast) {
          let htmlResult = "<tr>";
          htmlResult +=
            "<td colspan='4' align='center'><b>To Fast Delay 10 Seconds</b></td>";
          htmlResult += "</tr>";
          $("#htmlResult").prepend(htmlResult);
        } else if (response.data.error) {
          let htmlResult = "<tr>";
          htmlResult +=
            "<td colspan='4' align='center'><b> Blocked Error : " +
            response.data.error +
            "</b></td>";
          htmlResult += "</tr>";
          $("#htmlResult").prepend(htmlResult);
          this.stopTradding();
        } else {
          this.result.profit =
            response.data.PayOuts.reduce((a, b) => a + b, 0) +
            response.data.PayIns.reduce((a, b) => a + b, 0);
          this.result.payOut = this.result.profit + this.options.basePayIn;
          this.chartData.push([this.result.tradeListCount, this.balance]);
          this.tradeSingleHistories(response.data);
          this.tradeResult();
        }
      });
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
        this.temp.maxWinStreak += 1;
        if (this.temp.maxWinStreak > this.result.maxWinStreak) {
          this.result.maxWinStreak = this.temp.maxWinStreak;
        }
        this.temp.maxLoseStreak = 0;

        if (profit > this.result.maxTradeWin) {
          this.result.maxTradeWin = profit;
        }
        this.options.countWinStreak += 1;
        this.options.countLoseStreak = 0;
        this.tradeLogicHiLo.onWin += 1;
        this.result.tradeListCount += 1;
        let countTradeId = Number.parseInt(this.result.tradeListCount) - 1;
        htmlResult +=
          '<tr class="alert alert-fill-success mb-0" align="center" style="cursor: pointer;" data-toggle="collapse" data-target=".tradeList' +
          countTradeId +
          '" aria-expanded="false" aria-controls="tradeList' +
          countTradeId +
          '">';
        htmlResult += '<th scope="row">' + this.options.highLow + "</th>";
        htmlResult += "<td>" + trade.toFixed(2) + "</td>";
        htmlResult += "<td>" + payOut.toFixed(2) + "</td>";
        htmlResult += "<td>" + profit.toFixed(2) + "</td>";
        htmlResult += "</tr>";
        htmlResult +=
          "<tr align='center' class='table-warning collapse tradeList" +
          countTradeId +
          "' style='color: black'>";
        htmlResult += "<td colspan='2'><i>PayIns</i></td>";
        htmlResult += "<td colspan='2'><i>PayOuts</i></td>";
        htmlResult += "</tr>";
        $.each(this.result.tradeSingleHistoriesValue, function(key, value) {
          let payIns = Number.parseFloat(value.payIns * 0.00000001).toFixed(2);
          let payOuts = Number.parseFloat(value.payOuts * 0.00000001).toFixed(
            2
          );
          if (payOuts > 0) {
            htmlResult +=
              "<tr align='center' class='table-success collapse tradeList" +
              countTradeId +
              "' style='color: black'>";
            htmlResult += "<td colspan='2'><i>" + payIns + "</i></td>";
            htmlResult += "<td colspan='2'><i>" + payOuts + "</i></td>";
            htmlResult += "</tr>";
          } else {
            htmlResult +=
              "<tr align='center' class='table-danger collapse tradeList" +
              countTradeId +
              "' style='color: black'>";
            htmlResult += "<td colspan='2'><i>" + payIns + "</i></td>";
            htmlResult += "<td colspan='2'><i>" + payOuts + "</i></td>";
            htmlResult += "</tr>";
          }
        });
      } else {
        this.temp.maxLoseStreak += 1;
        if (this.temp.maxLoseStreak > this.result.maxLoseStreak) {
          this.result.maxLoseStreak = this.temp.maxWinStreak;
        }
        this.temp.maxWinStreak = 0;

        if (profit < this.result.maxTradeLose) {
          this.result.maxTradeLose = profit;
        }

        this.options.countLoseStreak += 1;
        this.options.countWinStreak = 0;
        this.tradeLogicHiLo.onLose += 1;
        let countTradeId = Number.parseInt(this.result.tradeListCount) - 1;
        htmlResult +=
          '<tr class="alert alert-fill-danger mb-0" align="center" style="cursor: pointer;" data-toggle="collapse" data-target=".tradeList' +
          countTradeId +
          '" aria-expanded="false" aria-controls="tradeList' +
          countTradeId +
          '">';
        htmlResult += '<th scope="row">' + this.options.highLow + "</th>";
        htmlResult += "<td>" + trade.toFixed(2) + "</td>";
        htmlResult += "<td>" + payOut.toFixed(2) + "</td>";
        htmlResult += "<td>" + profit.toFixed(2) + "</td>";
        htmlResult += "</tr>";

        htmlResult +=
          "<tr align='center' class='table-warning collapse tradeList" +
          countTradeId +
          "' style='color: black'>";
        htmlResult += "<td colspan='2'><i>PayIns</i></td>";
        htmlResult += "<td colspan='2'><i>PayOuts</i></td>";
        htmlResult += "</tr>";
        $.each(this.result.tradeSingleHistoriesValue, function(key, value) {
          let payIns = Number.parseFloat(value.payIns * 0.00000001).toFixed(2);
          let payOuts = Number.parseFloat(value.payOuts * 0.00000001).toFixed(
            2
          );
          if (payOuts > 0) {
            htmlResult +=
              "<tr align='center' class='table-success collapse tradeList" +
              countTradeId +
              "' style='color: black'>";
            htmlResult += "<td colspan='2'><i>" + payIns + "</i></td>";
            htmlResult += "<td colspan='2'><i>" + payOuts + "</i></td>";
            htmlResult += "</tr>";
          } else {
            htmlResult +=
              "<tr align='center' class='table-danger collapse tradeList" +
              countTradeId +
              "' style='color: black'>";
            htmlResult += "<td colspan='2'><i>" + payIns + "</i></td>";
            htmlResult += "<td colspan='2'><i>" + payOuts + "</i></td>";
            htmlResult += "</tr>";
          }
        });
      }

      this.result.profitSession += Number.parseFloat(profit);
      this.result.profitGlobal += Number.parseFloat(profit);
      this.balance += profit;
      $("#htmlResult").prepend(htmlResult);
    },
    tradeLogic() {
      if (this.settings.tradeLogicSelected.selectedValue == 1) {
        let sumTradeLogicWin =
          Number.parseInt(this.settings.tradeLogicHiLo.win) + 1;
        let sumTradeLogicLose =
          Number.parseInt(this.settings.tradeLogicHiLo.lose) + 1;
        if (this.tradeLogicHiLo.onWin == sumTradeLogicWin) {
          if (this.options.tradeLogic == false) {
            this.options.tradeLogic = true;
            this.options.highLow = "L";
          } else {
            this.options.tradeLogic = false;
            this.options.highLow = "H";
          }
          this.tradeLogicHiLo.onWin = 1;
        }
        if (this.tradeLogicHiLo.onLose == sumTradeLogicLose) {
          if (this.options.tradeLogic == false) {
            this.options.tradeLogic = true;
            this.options.highLow = "L";
          } else {
            this.options.tradeLogic = false;
            this.options.highLow = "H";
          }
          this.tradeLogicHiLo.onLose = 1;
        }
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
      this.getBalance();
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

      this.temp.maxWinStreak = 0;
      this.temp.maxLoseStreak = 0;

      this.result.tradeSingleHistoriesValue = [];

      this.options.countWinStreak = 0;
      this.options.countLoseStreak = 0;
      this.options.takeProfitGlobal = 0;
      this.options.takeProfitSession = 0;

      this.tradeLogicHiLo.onWin = 1;
      this.tradeLogicHiLo.onLose = 1;

      this.chartData = [];
      this.baseTradeAmount();
      this.sendMessage();
    },
    stopTradding() {
      this.tradeStatus = false;
      this.tradeLoader = false;
      this.stopOnWinLoader = false;
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
          this.options.IncreaseOnWinPercent = this.settings.martingleMulti.onWin.value;
        }
        if (this.settings.martingleMulti.onLose.status == true) {
          this.options.IncreaseOnLosePercent = this.settings.martingleMulti.onLose.value;
        }
      }
      if (this.settings.martingleMulti.sameSingle == true) {
        if (this.settings.martingleSingle.onWin.status == true) {
          this.options.IncreaseOnWinPercent = this.settings.martingleSingle.onWin.value;
        }
        if (this.settings.martingleSingle.onLose.status == true) {
          this.options.IncreaseOnLosePercent = this.settings.martingleSingle.onLose.value;
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

          const options = {
            url: "https://www.999doge.com/api/web.aspx",
            method: "POST",
            data: {
              a: "Withdraw",
              s: $cookies.get("SessionCookies"),
              Amount: Number.parseInt(amount / 0.00000001),
              Address: this.settings.autoWithdraw.destinationAddress,
              Totp: "",
              Currency: "doge"
            }
          };

          this.$axios(options).then(response => {
            let htmlResult = "<tr>";
            let wdAmount =
              this.balance - this.settings.autoWithdraw.initialBalance;
            htmlResult +=
              "<td colspan='4' align='center'><b>Withdraw " +
              wdAmount.toFixed(2) +
              " Doge</b></td>";
            htmlResult += "</tr>";
            $("#htmlResult").prepend(htmlResult);
            this.balance =
              this.balance -
              (this.balance - this.settings.autoWithdraw.initialBalance);
          });
          await this.delay(1000);
        }
      }
    },
    resetOnWinEvent() {
      //Define resetOnWin true or False
      if (Number.parseFloat(this.options.IncreaseOnWinPercent) <= 0) {
        this.options.resetOnWin = 1;
      }

      //Define resetOnLose true or False
      if (Number.parseFloat(this.options.IncreaseOnLosePercent) <= 0) {
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

      this.martingleMulti();
      this.martingleSingle();

      this.resetOnWinEvent();

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
    tradeSingleHistories(data) {
      let payIns = data.PayIns;
      let payOut = data.PayOuts;
      let outInsData = [];
      for (let i = 0; i < payIns.length; i++) {
        outInsData.push({
          payIns: payIns[i],
          payOuts: payOut[i]
        });
      }
      this.result.tradeSingleHistoriesValue = outInsData;
    }
  }
};
</script>
