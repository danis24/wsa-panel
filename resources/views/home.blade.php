@extends('layouts.app')

@section('content')
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
                            <b>1200</b> Doge
                            <div class="float-right">
                                <button class="btn btn-pill btn-success" type="button" id="refreshBalances"><i
                                        class="fe fe-refresh-cw"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-alert alert alert-primary mb-0">
                            TRADE STATUS : OFF
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
                        <button type="submit" class="btn btn-success btn-block">Start</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-danger btn-block  float-right">Stop</button>
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
                            <tr class="alert alert-success mb-0">
                                <th scope="row">H</th>
                                <td>20</td>
                                <td>2000</td>
                                <td>1880</td>
                            </tr>
                            <tr class="alert alert-danger mb-0">
                                <th scope="row">L</th>
                                <td>20</td>
                                <td>0</td>
                                <td>-1880</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection