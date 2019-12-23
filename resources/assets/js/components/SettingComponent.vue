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
                      <input type="number" class="form-control" placeholder="0" />
                    </div>
                    <div class="col-sm-1">-</div>
                    <div class="col-sm-5">
                      <input type="number" class="form-control" placeholder="0" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Trade Count</label>
                  <div class="row">
                    <div class="col-sm-5">
                      <input type="number" class="form-control" placeholder="0" />
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
                        v-model="tradeLogicSelected"
                        @change="tradeLogicSelectedEvent"
                      >
                        <option value="1">HIGH/LOW</option>
                        <option value="2">HIGH</option>
                        <option value="3">LOW</option>
                        <option value="4">RANDOM</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group" v-if="tradeLogicSelected == 1">
                  <div class="row">
                    <div class="col-sm-5">
                      <label class="form-label">Win HI/LO</label>
                      <input type="number" class="form-control" placeholder="0" />
                    </div>
                    <div class="col-sm-5">
                      <label class="form-label">Lose HI/LO</label>
                      <input type="number" class="form-control" placeholder="0" />
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Timeout</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="0" />
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
                        value="option1"
                        checked
                      />
                      <span class="custom-control-label">Stop</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="example-inline-radios"
                        value="option2"
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
                      <input type="number" class="form-control" placeholder="0" />
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
                      <input type="number" class="form-control" placeholder="0" />
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
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input type="number" class="form-control" placeholder="0" />
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
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input type="number" class="form-control" placeholder="0" />
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
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
                    <div class="col-sm-2">
                      <label class="custom-switch pt-2" style="padding-left: 0.25rem;">
                        <input
                          type="checkbox"
                          name="custom-switch-checkbox"
                          class="custom-switch-input"
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label">On Win</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="number" class="form-control" placeholder="0" />
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
                        />
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label">On Lose</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="number" class="form-control" placeholder="0" />
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
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
                          <input type="number" class="form-control" placeholder="0" />
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
                      <input type="number" class="form-control" placeholder="0" />
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" />
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
                        <input type="checkbox" class="custom-control-input" />
                        <span class="custom-control-label">Win Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="0" />
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
                            name="example-inline-radios"
                            value="option1"
                            checked
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="example-inline-radios"
                            value="option2"
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
                      <input type="number" class="form-control" placeholder="0" />
                      <label>Seconds</label>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" />
                        <span class="custom-control-label">Lose Streak</span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="0" />
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
                            name="example-inline-radios"
                            value="option1"
                            checked
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="example-inline-radios"
                            value="option2"
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
                      <input type="number" class="form-control" placeholder="0" />
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
                            name="example-inline-radios"
                            value="option1"
                            checked
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="example-inline-radios"
                            value="option2"
                          />
                          <span class="custom-control-label">Reset</span>
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
                      <input type="number" class="form-control" placeholder="0" />
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" />
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
                            name="example-inline-radios"
                            value="option1"
                            checked
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="example-inline-radios"
                            value="option2"
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
                            name="example-inline-radios"
                            value="option1"
                            checked
                          />
                          <span class="custom-control-label">Stop</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="example-inline-radios"
                            value="option2"
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
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
                          <input type="number" class="form-control" placeholder="0" />
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
                      name="custom-switch-checkbox"
                      class="custom-switch-input"
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
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
                          <input type="number" class="form-control" placeholder="0" />
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
                    <input type="number" class="form-control" placeholder="0" />
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
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" />
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
          </div>
          <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;" />
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="form-group">
                  <label class="form-label">Initial Balance</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="0" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Trigger Balance</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="0" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Destination Address</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="0" />
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
      tradeLogicSelected: 1
    };
  },
  methods: {
    tradeLogicSelectedEvent() {
      console.log(this.tradeLogicSelected);
    }
  }
};
</script>
