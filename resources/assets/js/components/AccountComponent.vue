<template>
	<div class="container">
		<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
							<div class="card-header">
									<h3 class="card-title">Account List</h3>
							</div>
							<div class="card-body o-auto" style="height: 20.5rem">
									<table class="table">
											<thead class="card-alert alert alert-primary mb-0">
													<tr>
															<th scope="col">#</th>
															<th scope="col">Account ID</th>
															<th scope="col">Username</th>
															<th scope="col">Options</th>
													</tr>
											</thead>
											<tbody>
													<tr class="alert alert-success mb-0">
															<th scope="row" width="5%">1</th>
															<th scope="row" width="5%">514515145411</th>
															<td>danis1 <div class="badge badge-warning badge-md">Loaded</div></td>
															<td class="pull-right" width="30%">
																<button class="btn btn-pill btn-danger" type="button" id="delete"><i
                                            class="fe fe-trash"></i></button>
																<button class="btn btn-pill btn-success" type="button" id="load"><i
                                            class="fe fe-refresh-cw"></i></button>
															</td>
													</tr>
													<tr class="alert alert-success mb-0">
															<th scope="row" width="5%">1</th>
															<th scope="row" width="5%">514515145411</th>
															<td>danis2</td>
															<td class="pull-right" width="30%">
																<button class="btn btn-pill btn-danger" type="button" id="delete"><i
                                            class="fe fe-trash"></i></button>
																<button class="btn btn-pill btn-success" type="button" id="load"><i
                                            class="fe fe-refresh-cw"></i></button>
															</td>
													</tr>
											</tbody>
									</table>
							</div>
					</div>
			</div>
      <div class="col-md-4">
          <div class="card card-default">
              <div class="card-header">Login/Create Account</div>

              <div class="card-body">
                  <form action="https://httpbin.org/post" method="post">
                  	<div class="form-group">
												<label class="form-label">Username</label>
												<input type="text" class="form-control" name="username" placeholder="Username.." aria-autocomplete="list">
										</div>

										<div class="form-group">
												<label class="form-label">Password</label>
												<input type="password" class="form-control" name="password" placeholder="Password.." aria-autocomplete="list">
										</div>

										<div class="form-group">
												<label class="form-label">2FA (if enable)</label>
												<input type="text" class="form-control" name="2fa" placeholder="2FA.." aria-autocomplete="list">
										</div>

                    <div class="row">
                        <div class="col">
														<button class="btn btn-pill btn-success" type="button"><i class="fe fe-lock"></i> Login</button>
														<button class="btn btn-pill btn-warning" type="button"><i class="fe fe-user"></i> Register</button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
      </div>
			<div class="col-md-6">
          <div class="card card-default">
              <div class="card-header">Deposit</div>

              <div class="card-body">
                  <button class="btn btn-pill btn-warning" type="button"><i class="fe fe-layers"></i> Get Address</button>
              </div>
          </div>
      </div>

			<div class="col-md-6">
          <div class="card card-default">
              <div class="card-header">Withdraw</div>

              <div class="card-body">
                  <form action="https://httpbin.org/post" method="post">
                  	<div class="form-group">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" name="username" placeholder="Username.." aria-autocomplete="list">
										</div>

										<div class="form-group">
												<label class="form-label">Amount</label>
												<input type="number" class="form-control" name="username" placeholder="Username.." aria-autocomplete="list">
										</div>

										<div class="form-group">
												<label class="form-label">2FA (if enable)</label>
												<input type="text" class="form-control" name="2fa" placeholder="2FA.." aria-autocomplete="list">
										</div>

										<div class="form-group">
												<button class="btn btn-pill btn-warning" type="button"><i class="fe fe-dollar-sign"></i> Withdraw</button>
										</div>
                  </form>
              </div>
          </div>
      </div>

		</div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>