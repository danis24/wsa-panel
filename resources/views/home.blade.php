@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="col-sm-11">
                        <h4 class="m-0"><a href="javascript:void(0)">0</a></h4>
                        <small class="text-muted">Lastrain</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="col-sm-11">
                        <h4 class="m-0">132 <small>DOGE</small></h4>
                        <small class="text-muted">Balances</small>
                    </div>
                    <div class="col-sm-1 align-items-right">
                        <button class="stamp stamp-md bg-blue">
                            <i class="fe fe-refresh-cw"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
