<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- trade Setting -->
        <div class="card card-default p-3">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Trade Settings</label>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Change Beetwen</label>
                  <div class="row">
                    <div class="col-sm-5">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        @change="firstChangeBeerwenValidate"
                        v-model="configData.changeBeetwen.first"
                      />
                    </div>
                    <div class="col-sm-1">-</div>
                    <div class="col-sm-5">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        @change="lastChangeBeerwenValidate"
                        v-model="configData.changeBeetwen.last"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Trade Count</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        @change="tradeCountValidate"
                        v-model="configData.tradeCount"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Trade Logic</label>
                  <div class="row">
                    <div class="col-sm-11">
                      <select
                        class="form-control"
                        v-model="configData.tradeLogicSelected.selectedValue"
                      >
                        <option value="1">HIGH/LOW</option>
                        <option value="2">HIGH</option>
                        <option value="3">LOW</option>
                        <option value="4">RANDOM</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group" v-if="configData.tradeLogicSelected.selectedValue == 1">
                  <div class="row">
                    <div class="col-sm-5">
                      <label class="form-label">Win HI/LO</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeLogicHiLo.win"
                      />
                    </div>
                    <div class="col-sm-5">
                      <label class="form-label">Lose HI/LO</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeLogicHiLo.lose"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Timeout -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label">Timeout Requests</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.timeOutRequest.timeOutRequest == true"
                      v-model="configData.timeOutRequest.timeOutRequest"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12" v-if="configData.timeOutRequest.timeOutRequest == true">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Timeout</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.timeOutRequest.timeOutRequestValue"
                      />
                      <label>
                        <i>Seconds</i>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="form-label">
                          <label>Timeout</label>
                        </div>
                        <div class="form-check" style="display: inline-flex;">
                          <label class="form-check-label">
                            <input
                              type="radio"
                              class="form-check-input"
                              name="ifTimeOut"
                              value="stop"
                              :checked="configData.timeOutRequest.ifTimeOut == 'stop'"
                              v-model="configData.timeOutRequest.ifTimeOut"
                            />
                            Stop
                            <i class="input-helper"></i>
                          </label>
                        </div>
                        <div class="form-check" style="display: inline-flex;">
                          <label class="form-check-label">
                            <input
                              type="radio"
                              class="form-check-input"
                              name="ifTimeOut"
                              value="delay"
                              :checked="configData.timeOutRequest.ifTimeOut == 'delay'"
                              v-model="configData.timeOutRequest.ifTimeOut"
                            />
                            Reset
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6"></div>
            </div>
          </div>
        </div>
        <!-- Delay -->
        <div class="card card-default p-3 mt-4">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Delay</label>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-label">On Win</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.delay.onWin"
                      />
                      <label>
                        <i>Seconds</i>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-label">On Lose</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.delay.onLose"
                      />
                      <label>
                        <i>Seconds</i>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Martingle Single Tradecount -->
        <div class="card card-default p-3 mt-4">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Martingle Single Tradecount</label>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-check" style="margin-top: 2rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.martingleSingle.onWin.status == true"
                            v-model="configData.martingleSingle.onWin.status"
                          />
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.martingleSingle.onWin.value"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-check" style="margin-top: 2rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.martingleSingle.onLose.status"
                            v-model="configData.martingleSingle.onLose.status"
                          />
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.martingleSingle.onLose.value"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Martingle Multi Tradecount -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label">Martingle Multi Tradecount</label>
              </div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="label">Same as Martingle Single</label>
              </div>
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.martingleMulti.sameSingle == true"
                      v-model="configData.martingleMulti.sameSingle"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12" v-if="configData.martingleMulti.sameSingle == false">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-check" style="margin-top: 2rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.martingleMulti.onWin.status == true"
                            v-model="configData.martingleMulti.onWin.status"
                          />
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.martingleMulti.onWin.value"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-check" style="margin-top: 2rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.martingleMulti.onLose.status"
                            v-model="configData.martingleMulti.onLose.status"
                          />
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.martingleMulti.onLose.value"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Base Trade Amount -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label">Base Trade Amount</label>
              </div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="form-label">Use Persentage</label>
              </div>
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.baseTradeAmount.usePersentage == true"
                      v-model="configData.baseTradeAmount.usePersentage"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Base Trade</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.baseTradeAmount.value"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Trade Amount -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label">Trade Amount</label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Profit</label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.profit.value"
                      />
                      <div class="form-check">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.tradeAmount.profit.mathBaseAmount == true"
                            v-model="configData.tradeAmount.profit.mathBaseAmount"
                          />
                          <i class="input-helper">X Base Amount</i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-check" style="margin-top: 0.3rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.tradeAmount.winStreak.status"
                            v-model="configData.tradeAmount.winStreak.status"
                          />
                          <i class="input-helper">Win Streak</i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.winStreak.value"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">On Win Streak</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="tradeAmountOnWinStreak"
                            value="true"
                            :checked="configData.tradeAmount.winStreak.onWinStreak == true"
                            v-model="configData.tradeAmount.winStreak.onWinStreak"
                          />
                          Stop
                          <i class="input-helper"></i>
                        </label>
                      </div>

                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="tradeAmountOnWinStreak"
                            value="false"
                            :checked="configData.tradeAmount.winStreak.onWinStreak == false"
                            v-model="configData.tradeAmount.winStreak.onWinStreak"
                          />
                          Reset
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">If Reset Delay</label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.winStreak.ifResetDelay"
                      />
                      <label>Seconds</label>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-check" style="margin-top: 0.3rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.tradeAmount.loseStreak.status == true"
                            v-model="configData.tradeAmount.loseStreak.status"
                          />
                          <i class="input-helper">Lose Streak</i>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.loseStreak.value"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">On Lose Streak</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="tradeAmountOnLoseStreak"
                            value="true"
                            :checked="configData.tradeAmount.loseStreak.onLoseStreak == true"
                            v-model="configData.tradeAmount.loseStreak.onLoseStreak"
                          />
                          Stop
                          <i class="input-helper"></i>
                        </label>
                      </div>
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="tradeAmountOnLoseStreak"
                            value="false"
                            :checked="configData.tradeAmount.loseStreak.onLoseStreak == false"
                            v-model="configData.tradeAmount.loseStreak.onLoseStreak"
                          />
                          Reset
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">If Reset Delay</label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.loseStreak.ifResetDelay"
                      />
                      <label>Seconds</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">If Reset Recover Lose</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="ifResetRecoverLose"
                            value="true"
                            :checked="configData.tradeAmount.loseStreak.ifResetRecoverLose == true"
                            v-model="configData.tradeAmount.loseStreak.ifResetRecoverLose"
                          />
                          Yes
                          <i class="input-helper"></i>
                        </label>
                      </div>
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="ifResetRecoverLose"
                            value="false"
                            :checked="configData.tradeAmount.loseStreak.ifResetRecoverLose == false"
                            v-model="configData.tradeAmount.loseStreak.ifResetRecoverLose"
                          />
                          No
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Max Trade Amount</label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.tradeAmount.maxTradeAmount.value"
                      />
                      <div class="form-check" style="margin-top: 2rem">
                        <label class="form-check-label">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            :checked="configData.tradeAmount.maxTradeAmount.mathBaseAmount == true"
                            v-model="configData.tradeAmount.maxTradeAmount.mathBaseAmount"
                          />
                          <i class="input-helper">X Base Amount</i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Max Trade On Win</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="maxTradeOnWin"
                            value="true"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnWin == true"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnWin"
                          />
                          Stop
                          <i class="input-helper"></i>
                        </label>
                      </div>
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="maxTradeOnWin"
                            value="false"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnWin == false"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnWin"
                          />
                          Reset
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Max Trade On Lose</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="maxTradeOnLose"
                            value="true"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnLose == true"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnLose"
                          />
                          Stop
                          <i class="input-helper"></i>
                        </label>
                      </div>
                      <div class="form-check" style="display: inline-flex;">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="maxTradeOnLose"
                            value="false"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnLose == false"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnLose"
                          />
                          Reset
                          <i class="input-helper"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Take Profit Global -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label">Take Profit Global</label>
              </div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="label">Use Persentage</label>
              </div>
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.takeProfitGlobal.usePersentage == true"
                      v-model="configData.takeProfitGlobal.usePersentage"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Profit Global</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.takeProfitGlobal.profitGlobalValue"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="float-sm-left">
                  <label class="label">Stop After Take Profit</label>
                </div>
                <div class="float-sm-right text-right">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input
                        type="checkbox"
                        class="form-check-input"
                        :checked="configData.takeProfitGlobal.stop == true"
                        v-model="configData.takeProfitGlobal.stop"
                      />
                      <i class="input-helper"></i>
                    </label>
                  </div>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Take Profit Sessions -->
        <div class="card card-default p-3 mt-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label">Take Profit Sessions</label>
              </div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="label">Use Persentage</label>
              </div>
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.takeProfitSession.usePersentage == true"
                      v-model="configData.takeProfitSession.usePersentage"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Profit Sessions</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="configData.takeProfitSession.profitSessionValue"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-3">
                    <label class="form-label">Delay</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="0"
                      v-model="configData.takeProfitSession.delay"
                    />
                    <label class="form-label">
                      <i>Seconds</i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Auto Withdraw -->
        <div class="card p-3 mt-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="form-label">Auto Withdraw</label>
              </div>
              <div class="float-sm-right text-right">
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :checked="configData.autoWithdraw.status == true"
                      v-model="configData.autoWithdraw.status"
                    />
                    <i class="input-helper"></i>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12" v-if="configData.autoWithdraw.status == true">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Initial Balance</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.autoWithdraw.initialBalance"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Trigger Balance</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="configData.autoWithdraw.triggeredBalance"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Destination Address</label>
                  <div class="row">
                    <div class="col-sm-12">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Destination Address .."
                        v-model="configData.autoWithdraw.destinationAddress"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="saveAsModalLabel">Save As</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label class="form-label">Settings Name</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Settings Name"
                  v-model="settingNameValue"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <div v-if="this.saveSettingLoader === true">
              <button class="btn btn-primary btn-block d-flex justify-content-center">
                <fulfilling-bouncing-circle-spinner
                  :animation-duration="4000"
                  :size="25"
                  color="#fff"
                />
              </button>
            </div>
            <div v-if="this.saveSettingLoader === false">
              <button
                type="button"
                class="btn btn-primary"
                @click.prevent="saveAsEvent"
              >Save Settings</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class style="position: fixed; bottom: 0px; right: 0px;">
      <div class="float-sm-right">
        <div class="card alert alert-primary">
          <template v-if="this.saveLoader === true">
            <button class="btn btn-outline-success btn-icon-text d-flex justify-content-center">
              <!-- <fulfilling-bouncing-circle-spinner :animation-duration="4000" :size="25" color="#fff" /> -->
              <hollow-dots-spinner
                :animation-duration="1000"
                :dot-size="20"
                :dots-num="3"
                color="#fff"
              />
            </button>
          </template>
          <div v-if="this.saveLoader === false">
            <button class="btn btn-outline-success btn-icon-text mt-2" @click.prevent="saveConfig">
              <i class="mdi mdi-content-save btn-icon-prepend"></i> Save
            </button>
          </div>
          <button
            class="btn btn-outline-danger btn-icon-text mt-2"
            data-toggle="modal"
            data-target="#saveAsModal"
          >
            <i class="mdi mdi-content-save-all btn-icon-prepend"></i> Save As
          </button>
          <router-link to="/settings/loads" class="btn btn-outline-warning btn-icon-text mt-2">
            <i class="mdi mdi-folder-download btn-icon-prepend"></i> Load
          </router-link>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { HollowDotsSpinner } from "epic-spinners";
import { FulfillingBouncingCircleSpinner } from "epic-spinners";
import $ from "jquery";

export default {
  components: {
    HollowDotsSpinner,
    FulfillingBouncingCircleSpinner
  },
  data() {
    return {
      saveSettingLoader: false,
      settingNameValue: "",
      showModal: false,
      saveLoader: false,
      configData: {
        changeBeetwen: {
          first: 5,
          last: 95
        },
        tradeCount: 200,
        tradeLogicSelected: {
          selectedValue: 1
        },
        tradeLogicHiLo: {
          win: 1,
          lose: 1
        },
        timeOutRequest: {
          timeOutRequest: false,
          timeOutRequestValue: 0,
          ifTimeOut: "stop"
        },
        delay: {
          onWin: 0,
          onLose: 0
        },
        martingleSingle: {
          onWin: {
            status: false,
            value: 0
          },
          onLose: {
            status: false,
            value: 0
          }
        },

        martingleMulti: {
          sameSingle: false,
          onWin: {
            status: false,
            value: 0
          },
          onLose: {
            status: false,
            value: 0
          }
        },

        baseTradeAmount: {
          usePersentage: false,
          value: 1
        },

        tradeAmount: {
          profit: {
            mathBaseAmount: false,
            value: 0
          },
          winStreak: {
            status: false,
            value: 0,
            onWinStreak: true,
            ifResetDelay: 0
          },
          loseStreak: {
            status: false,
            value: 0,
            onLoseStreak: true,
            ifResetDelay: 0,
            ifResetRecoverLose: true
          },
          maxTradeAmount: {
            mathBaseAmount: false,
            value: 0,
            maxTradeOnWin: true,
            maxTradeOnLose: true
          }
        },

        takeProfitGlobal: {
          usePersentage: false,
          profitGlobalValue: 0,
          stop: false
        },

        takeProfitSession: {
          usePersentage: false,
          profitSessionValue: 0,
          delay: 0
        },

        autoWithdraw: {
          status: false,
          initialBalance: 0,
          triggeredBalance: 0,
          destinationAddress: ""
        }
      }
    };
  },
  mounted() {
    if (JSON.parse(this.$localStorage.get("configData")) != null) {
      this.configData = JSON.parse(this.$localStorage.get("configData"));
    }
  },
  methods: {
    saveAsEvent: function() {
      this.saveSettingLoader = true;
      let baseUrl = "https://larabot24.com/settings/create";
      var bodyFormData = new FormData();
      bodyFormData.set("settings_name", this.settingNameValue);
      bodyFormData.set("config_data", JSON.stringify(this.configData));
      this.axios.post(baseUrl, bodyFormData).then(response => {
        let toast = this.$toasted.show(response.data.message, {
          theme: "toasted-primary",
          position: "top-right",
          duration: 3000
        });
        this.saveSettingLoader = false;
        $("#saveAsModal").modal("hide");
        this.$emit("saveAsEvent");
      });
    },
    firstChangeBeerwenValidate: function() {
      if (
        this.configData.changeBeetwen.first < 5 ||
        this.configData.changeBeetwen.first > 95
      ) {
        let toast = this.$toasted.show("Change Beetwen Must Be 5 - 95 !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 3000
        });
        this.configData.changeBeetwen.first = 5;
      }

      if (
        this.configData.changeBeetwen.first > this.configData.changeBeetwen.last
      ) {
        let toast = this.$toasted.show(
          "First change must be less then the last !",
          {
            theme: "toasted-primary",
            position: "top-right",
            duration: 3000
          }
        );
        this.configData.changeBeetwen.first = 5;
        this.configData.changeBeetwen.last = 95;
      }
    },
    lastChangeBeerwenValidate: function() {
      if (
        this.configData.changeBeetwen.last < 5 ||
        this.configData.changeBeetwen.last > 95
      ) {
        let toast = this.$toasted.show("Change Beetwen Must Be 5 - 95 !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 3000
        });
        this.configData.changeBeetwen.last = 95;
      }
      if (
        this.configData.changeBeetwen.first > this.configData.changeBeetwen.last
      ) {
        let toast = this.$toasted.show(
          "First change must be less then the last !",
          {
            theme: "toasted-primary",
            position: "top-right",
            duration: 3000
          }
        );
        this.configData.changeBeetwen.first = 5;
        this.configData.changeBeetwen.last = 95;
      }
    },
    tradeCountValidate: function() {
      if (this.configData.tradeCount < 1 || this.configData.tradeCount > 200) {
        let toast = this.$toasted.show("Trade Count Must Be 1 - 200 !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 3000
        });
        this.configData.tradeCount = 200;
      }
    },
    saveConfig() {
      this.saveLoader = true;
      if (
        this.$localStorage.set("configData", JSON.stringify(this.configData))
      ) {
        this.saveLoader = false;
        let toast = this.$toasted.show("Setting Saved !", {
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000
        });
      }
    }
  }
};
</script>
