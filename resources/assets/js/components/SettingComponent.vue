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
                    :checked="configData.timeOutRequest.timeOutRequest == true"
                    v-model="configData.timeOutRequest.timeOutRequest"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12" v-if="configData.timeOutRequest.timeOutRequest == true">
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
                        v-model="configData.timeOutRequest.timeOutRequestValue"
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
                        name="ifTimeOut"
                        value="stop"
                        :checked="configData.timeOutRequest.ifTimeOut == 'stop'"
                        v-model="configData.timeOutRequest.ifTimeOut"
                      />
                      <span class="custom-control-label">Stop</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="ifTimeOut"
                        value="delay"
                        :checked="configData.timeOutRequest.ifTimeOut == 'delay'"
                        v-model="configData.timeOutRequest.ifTimeOut"
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
                        v-model="configData.delay.onWin"
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
                        v-model="configData.delay.onLose"
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
                          :checked="configData.martingleSingle.onWin.status == true"
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="configData.martingleSingle.onLose.status"
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
                    :checked="configData.martingleMulti.sameSingle == true"
                    v-model="configData.martingleMulti.sameSingle"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="configData.martingleMulti.onWin.status == true"
                          v-model="configData.martingleMulti.onWin.status"
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
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                          :checked="configData.martingleMulti.onLose.status"
                          v-model="configData.martingleMulti.onLose.status"
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
                    :checked="configData.baseTradeAmount.usePersentage == true"
                    v-model="configData.baseTradeAmount.usePersentage"
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
                        v-model="configData.tradeAmount.profit.value"
                      />
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="configData.tradeAmount.profit.mathBaseAmount == true"
                          v-model="configData.tradeAmount.profit.mathBaseAmount"
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
                          :checked="configData.tradeAmount.winStreak.status"
                          v-model="configData.tradeAmount.winStreak.status"
                        />
                        <span class="custom-control-label">Win Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnWinStreak"
                            value="true"
                            :checked="configData.tradeAmount.winStreak.onWinStreak == true"
                            v-model="configData.tradeAmount.winStreak.onWinStreak"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnWinStreak"
                            value="false"
                            :checked="configData.tradeAmount.winStreak.onWinStreak == false"
                            v-model="configData.tradeAmount.winStreak.onWinStreak"
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
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="configData.tradeAmount.loseStreak.status == true"
                          v-model="configData.tradeAmount.loseStreak.status"
                        />
                        <span class="custom-control-label">Lose Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnLoseStreak"
                            value="true"
                            :checked="configData.tradeAmount.loseStreak.onLoseStreak == true"
                            v-model="configData.tradeAmount.loseStreak.onLoseStreak"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="tradeAmountOnLoseStreak"
                            value="false"
                            :checked="configData.tradeAmount.loseStreak.onLoseStreak == false"
                            v-model="configData.tradeAmount.loseStreak.onLoseStreak"
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
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="ifResetRecoverLose"
                            value="true"
                            :checked="configData.tradeAmount.loseStreak.ifResetRecoverLose == true"
                            v-model="configData.tradeAmount.loseStreak.ifResetRecoverLose"
                          />
                          <span class="custom-control-label">Yes</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="ifResetRecoverLose"
                            value="false"
                            :checked="configData.tradeAmount.loseStreak.ifResetRecoverLose == false"
                            v-model="configData.tradeAmount.loseStreak.ifResetRecoverLose"
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
                        v-model="configData.tradeAmount.maxTradeAmount.value"
                      />
                      <label class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :checked="configData.tradeAmount.maxTradeAmount.mathBaseAmount == true"
                          v-model="configData.tradeAmount.maxTradeAmount.mathBaseAmount"
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
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnWin == true"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnWin"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnWin"
                            value="false"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnWin == false"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnWin"
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
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnLose == true"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnLose"
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="maxTradeOnLose"
                            value="false"
                            :checked="configData.tradeAmount.maxTradeAmount.maxTradeOnLose == false"
                            v-model="configData.tradeAmount.maxTradeAmount.maxTradeOnLose"
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
                    :checked="configData.takeProfitGlobal.usePersentage == true"
                    v-model="configData.takeProfitGlobal.usePersentage"
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
                  <label class="custom-switch">
                    <input
                      type="checkbox"
                      name="stopAfterTakeProfit"
                      class="custom-switch-input"
                      :checked="configData.takeProfitGlobal.stop == true"
                      v-model="configData.takeProfitGlobal.stop"
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
                    :checked="configData.takeProfitSession.usePersentage == true"
                    v-model="configData.takeProfitSession.usePersentage"
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
                  <div class="col-sm-6">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="0"
                      v-model="configData.takeProfitSession.delay"
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
                    :checked="configData.autoWithdraw.status == true"
                    v-model="configData.autoWithdraw.status"
                  />
                  <span class="custom-switch-indicator"></span>
                </label>
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

      <div class="col-md-4">
        <div class="card p-3" v-if="this.saveLoader === true">
          <button class="btn btn-success btn-block d-flex justify-content-center">
            <!-- <fulfilling-bouncing-circle-spinner :animation-duration="4000" :size="25" color="#fff" /> -->
            <hollow-dots-spinner
              :animation-duration="1000"
              :dot-size="20"
              :dots-num="3"
              color="#fff"
            />
          </button>
        </div>
        <div class="card p-3" v-if="this.saveLoader === false">
          <button class="btn btn-success btn-block float-right" @click.prevent="saveConfig">Save</button>
        </div>
        <div class="card p-3">
          <div class="row">
            <div class="col-6">
              <div>
                <button
                  class="btn btn-danger btn-block"
                  data-toggle="modal"
                  data-target="#saveAsModal"
                >Save As</button>
              </div>
            </div>
            <div class="col-6">
              <router-link to="/settings/loads" class="btn btn-warning btn-block float-right">Load</router-link>
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
      let baseUrl = "http://localhost:8000/settings/create";
      var bodyFormData = new FormData();
      bodyFormData.set("settings_name", this.settingNameValue);
      bodyFormData.set("config_data", JSON.stringify(this.configData));
      this.axios.post(baseUrl, bodyFormData).then(response => {
        let toast = this.$toasted.show(response.data.message, {
          theme: "toasted-primary",
          position: "top-left",
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
          position: "top-left",
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
            position: "top-left",
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
          position: "top-left",
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
            position: "top-left",
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
          position: "top-left",
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
          position: "top-left",
          duration: 5000
        });
      }
    }
  }
};
</script>
