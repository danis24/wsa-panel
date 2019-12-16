<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default p-3">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Trade Settings</label>
              <hr style="margin-top: 0.4rem; margin-bottom: 0.6rem;">
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <div class="form-group">
              <label class="form-label">Change Beetwen</label>
              <div class="row">
                <div class="col-sm-5">
                  <input type="number" class="form-control" placeholder="0">
                </div>
                <div class="col-sm-1">
                  -
                </div>
                <div class="col-sm-5">
                  <input type="number" class="form-control" placeholder="0">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <div class="form-group">
              <label class="form-label">Trade Count</label>
              <div class="row">
                <div class="col-sm-5">
                  <input type="number" class="form-control" placeholder="0">
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-6">
            <div class="form-group">
              <label class="form-label">Trade Logic</label>
              <div class="row">
                <div class="col-sm-11">
                  <select class="form-control">
                    <option value="1">HIGH/LOW</option>
                    <option value="2">HIGH</option>
                    <option value="3">LOW</option>
                    <option value="4">RANDOMW</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-5">
                  <label class="form-label">Win HI/LO</label>
                  <input type="number" class="form-control" placeholder="0">
                </div>
                <div class="col-sm-5">
                  <label class="form-label">Lose HI/LO</label>
                  <input type="number" class="form-control" placeholder="0">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-default p-3">
        <div class="card-header">
          <div class="text-left col-sm-6">
            Timeout Requests
          </div>
          <div class="col-sm-6 text-right">
            <div class="form-group">
              <label class="custom-switch">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                <span class="custom-switch-indicator"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-lg-6">
              <div class="form-group">
                <label class="form-label">Timeout</label>
                <div class="row">
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="0">
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
                    <input type="radio" class="custom-control-input" name="example-inline-radios" value="option1" checked="">
                    <span class="custom-control-label">Stop</span>
                  </label>
                  <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="example-inline-radios" value="option2">
                    <span class="custom-control-label">Delay</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-default p-3">
        <div class="card-header">
          <div class="text-left col-sm-6">
            Delay
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-lg-6">
              <div class="form-group">
                <label class="form-label">On Win</label>
                <div class="row">
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="0">
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
                    <input type="number" class="form-control" placeholder="0">
                  </div>
                  <div class="col-sm-6">Seconds</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="card card-default p-3">
        <div class="row">
          <div class="col-sm-6">
            <button class="btn btn-danger btn-block">Save As</button>
          </div>
          <div class="col-sm-6">
            <button class="btn btn-warning btn-block">Load</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {

}
</script>
