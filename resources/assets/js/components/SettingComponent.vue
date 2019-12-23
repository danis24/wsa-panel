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
                        v-model="changeBeetwen.first"
                      />
                    </div>
                    <div class="col-sm-1">-</div>
                    <div class="col-sm-5">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        @change="lastChangeBeerwenValidate"
                        v-model="changeBeetwen.last"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Trade Count</label>
                  <div class="row">
                    <div class="col-sm-5">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        @change="tradeCountValidate"
                        v-model="tradeCount"
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
                      <select class="form-control" v-model="tradeLogicSelected.selectedValue">
                        <option value="1">HIGH/LOW</option>
                        <option value="2">HIGH</option>
                        <option value="3">LOW</option>
                        <option value="4">RANDOM</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group" v-if="tradeLogicSelected.selectedValue == 1">
                  <div class="row">
                    <div class="col-sm-5">
                      <label class="form-label">Win HI/LO</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeLogicHiLo.win"
                      />
                    </div>
                    <div class="col-sm-5">
                      <label class="form-label">Lose HI/LO</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeLogicHiLo.lose"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Timeout -->
        <div class="card card-default p-3">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label">Timeout Requests</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="text-right">
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="custom-switch-checkbox"
                    class="custom-switch-input"
                    :checked="timeOutRequest.timeOutRequest == true"
                    @click="timeOutRequestEvent"
                    v-model="timeOutRequest.timeOutRequest"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12" v-if="timeOutRequest.timeOutRequest == true">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Timeout</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="timeOutRequest.timeOutRequestValue"
                      />
                    </div>
                    <div class="col-sm-6">Seconds</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <div class="form-label">If Timeout</div>
                  <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio custom-control-inline">
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="example-inline-radios"
                        :checked="timeOutRequest.ifTimeOut == 'stop'"
                        @click="ifTimeOutEvent('stop')"
                      />
                      <span class="custom-control-label">Stop</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="example-inline-radios"
                        :checked="timeOutRequest.ifTimeOut == 'delay'"
                        @click="ifTimeOutEvent('delay')"
                      />
                      <span class="custom-control-label">Delay</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Delay -->
        <div class="card card-default p-3">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Delay</label>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">On Win</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="delay.onWin"
                      />
                    </div>
                    <div class="col-sm-6">Seconds</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">On Lose</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="delay.onLose"
                      />
                    </div>
                    <div class="col-sm-6">Seconds</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Martingle Single Tradecount -->
        <div class="card card-default p-3">
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="martingleSingle.onWin.status == true"
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="martingleSingle.onWin.value"
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="martingleSingle.onLose.status"
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="martingleSingle.onLose.value"
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
        <div class="card card-default p-3">
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
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="custom-switch-checkbox"
                    class="custom-switch-input"
                    :checked="martingleMulti.sameSingle == true"
                    @click="sameMartingleSingleEvent"
                    v-model="martingleMulti.sameSingle"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>

              <div class="clearfix"></div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
          </div>
          <div class="col-sm-12" v-if="martingleMulti.sameSingle == false">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="martingleMulti.onWin.status == true"
                          v-model="martingleMulti.onWin.status"
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="martingleMulti.onWin.value"
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="martingleMulti.onLose.status"
                          v-model="martingleMulti.onLose.status"
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="martingleMulti.onLose.value"
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
        <div class="card card-default p-3">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label">Base Trade Amount</label>
              </div>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
            </div>
            <div class="col-sm-12">
              <div class="float-sm-left">
                <label class="label">Use Persentage</label>
              </div>
              <div class="float-sm-right text-right">
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="custom-switch-checkbox"
                    class="custom-switch-input"
                    :checked="baseTradeAmount.usePersentage == true"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
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
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="baseTradeAmount.value"
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
        <div class="card card-default p-3">
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
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.profit.value"
                      />
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="tradeAmount.profit.mathBaseAmount == true"
                          v-model="tradeAmount.profit.mathBaseAmount"
                        />
                        <span class="custom-control-label">X Base Amount</span>
                      </label>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="tradeAmount.winStreak.status"
                          v-model="tradeAmount.winStreak.status"
                        />
                        <span class="custom-control-label">Win Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.winStreak.value"
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnWinStreak"
                            value="true"
                            :checked="tradeAmount.winStreak.onWinStreak == true"
                            v-model="tradeAmount.winStreak.onWinStreak"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnWinStreak"
                            value="false"
                            :checked="tradeAmount.winStreak.onWinStreak == false"
                            v-model="tradeAmount.winStreak.onWinStreak"
                          />
                          <span class="custom-control-label">Reset</span>
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
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.winStreak.ifResetDelay"
                      />
                      <label>Seconds</label>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="tradeAmount.loseStreak.status == true"
                          v-model="tradeAmount.loseStreak.status"
                        />
                        <span class="custom-control-label">Lose Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.loseStreak.value"
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnLoseStreak"
                            value="true"
                            :checked="tradeAmount.loseStreak.onLoseStreak == true"
                            v-model="tradeAmount.loseStreak.onLoseStreak"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnLoseStreak"
                            value="false"
                            :checked="tradeAmount.loseStreak.onLoseStreak == false"
                            v-model="tradeAmount.loseStreak.onLoseStreak"
                          />
                          <span class="custom-control-label">Reset</span>
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
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.loseStreak.ifResetDelay"
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="ifResetRecoverLose"
                            value="true"
                            :checked="tradeAmount.loseStreak.ifResetRecoverLose == true"
                            v-model="tradeAmount.loseStreak.ifResetRecoverLose"
                          />
                          <span class="custom-control-label">Yes</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="ifResetRecoverLose"
                            value="false"
                            :checked="tradeAmount.loseStreak.ifResetRecoverLose == false"
                            v-model="tradeAmount.loseStreak.ifResetRecoverLose"
                          />
                          <span class="custom-control-label">No</span>
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
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="tradeAmount.maxTradeAmount.value"
                      />
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="tradeAmount.maxTradeAmount.mathBaseAmount == true"
                        />
                        <span class="custom-control-label">X Base Amount</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Max Trade On Win</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnWin"
                            value="true"
                            :checked="tradeAmount.maxTradeAmount.maxTradeOnWin == true"
                            v-model="tradeAmount.maxTradeAmount.maxTradeOnWin"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnWin"
                            value="false"
                            :checked="tradeAmount.maxTradeAmount.maxTradeOnWin == false"
                            v-model="tradeAmount.maxTradeAmount.maxTradeOnWin"
                          />
                          <span class="custom-control-label">Reset</span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="form-label">Max Trade On Lose</label>
                    </div>
                    <div class="col-sm-6">
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnLose"
                            value="true"
                            :checked="tradeAmount.maxTradeAmount.maxTradeOnLose == true"
                            v-model="tradeAmount.maxTradeAmount.maxTradeOnLose"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnLose"
                            value="false"
                            :checked="tradeAmount.maxTradeAmount.maxTradeOnLose == false"
                            v-model="tradeAmount.maxTradeAmount.maxTradeOnLose"
                          />
                          <span class="custom-control-label">Reset</span>
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
        <div class="card card-default p-3">
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
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="usePersentageTakeProfitGlobal"
                    class="custom-switch-input"
                    :checked="takeProfitGlobal.usePersentage == true"
                    v-model="takeProfitGlobal.usePersentage"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
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
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="takeProfitGlobal.profitGlobalValue"
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
                  <label class="custom-switch">
                    <input
                      type="checkbox"
                      name="stopAfterTakeProfit"
                      class="custom-switch-input"
                      :checked="takeProfitGlobal.stop == true"
                      v-model="takeProfitGlobal.stop"
                    />
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Take Profit Sessions -->
        <div class="card card-default p-3">
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
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="custom-switch-checkbox"
                    class="custom-switch-input"
                    :checked="takeProfitSession.usePersentage == true"
                    v-model="takeProfitSession.usePersentage"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
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
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-12">
                          <input
                            type="number"
                            class="form-control"
                            placeholder="0"
                            v-model="takeProfitSession.profitSessionValue"
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
                  <div class="col-sm-6">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="0"
                      v-model="takeProfitSession.delay"
                    />
                    <label>Seconds</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Auto Withdraw -->
        <div class="card card-default p-3">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label">Auto Withdraw</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="text-right">
                <label class="custom-switch">
                  <input
                    type="checkbox"
                    name="autoWithdraw"
                    class="custom-switch-input"
                    :checked="autoWithdraw.status == true"
                    v-model="autoWithdraw.status"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12" v-if="autoWithdraw.status == true">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Initial Balance</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="autoWithdraw.initialBalance"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Trigger Balance</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="number"
                        class="form-control"
                        placeholder="0"
                        v-model="autoWithdraw.triggeredBalance"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Destination Address</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="0"
                        v-model="autoWithdraw.destinationAddress"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3">
          <button class="btn btn-success btn-block float-right">Save</button>
        </div>
        <div class="card p-3">
          <div class="row">
            <div class="col-6">
              <div>
                <button class="btn btn-danger btn-block">Save As</button>
              </div>
            </div>
            <div class="col-6">
              <button class="btn btn-warning btn-block float-right">Load</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
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
          status: true,
          value: 0,
          onLoseStreak: true,
          ifResetDelay: 0,
          ifResetRecoverLose: true
        },
        maxTradeAmount: {
          mathBaseAmount: true,
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
    };
  },
  methods: {
    firstChangeBeerwenValidate: function() {
      if (this.changeBeetwen.first < 5 || this.changeBeetwen.first > 95) {
        let toast = this.$toasted.show("Change Beetwen Must Be 5 - 95 !", {
          theme: "toasted-primary",
          position: "top-left",
          duration: 3000
        });
        this.changeBeetwen.first = 5;
      }

      if (this.changeBeetwen.first > this.changeBeetwen.last) {
        let toast = this.$toasted.show(
          "First change must be less then the last !",
          {
            theme: "toasted-primary",
            position: "top-left",
            duration: 3000
          }
        );
        this.changeBeetwen.first = 5;
        this.changeBeetwen.last = 95;
        console.log("first");
      }
    },
    lastChangeBeerwenValidate: function() {
      if (this.changeBeetwen.last < 5 || this.changeBeetwen.last > 95) {
        let toast = this.$toasted.show("Change Beetwen Must Be 5 - 95 !", {
          theme: "toasted-primary",
          position: "top-left",
          duration: 3000
        });
        this.changeBeetwen.last = 95;
      }
      if (this.changeBeetwen.first > this.changeBeetwen.last) {
        let toast = this.$toasted.show(
          "First change must be less then the last !",
          {
            theme: "toasted-primary",
            position: "top-left",
            duration: 3000
          }
        );
        this.changeBeetwen.first = 5;
        this.changeBeetwen.last = 95;
        console.log("last");
      }
    },
    tradeCountValidate: function() {
      if (this.tradeCount < 1 || this.tradeCount > 200) {
        let toast = this.$toasted.show("Trade Count Must Be 1 - 200 !", {
          theme: "toasted-primary",
          position: "top-left",
          duration: 3000
        });
        this.tradeCount = 200;
      }
    },
    timeOutRequestEvent: function() {
      console.log(this.timeOutRequest.ifTimeOut);
    },
    ifTimeOutEvent: function(event) {
      console.log(event);
    },
    sameMartingleSingleEvent: function() {
      console.log(this.martingleMulti.sameSingle);
    }
  }
};
</script>
