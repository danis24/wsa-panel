@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-12">
        <form class="card">
            <div class="card-alert alert alert-primary mb-0">
                <label class="form-label">Change Between</label>

                <div class="row">
                    <div class="col-5">
                        <div class="input-icon">
                            <input type="number" class="form-control" placeholder="0">
                            </span>
                        </div>
                    </div>
                    <div class="col-2 text-center">X
                    </div>
                    <div class="col-5">
                        <div class="input-icon">
                            <input type="number" class="form-control" placeholder="0">
                            </span>
                        </div>
                    </div>
                </div>

                <label class="form-label mt-5">Trade Count</label>
                <div class="row">
                    <div class="col-5">
                        <div class="input-icon">
                            <input type="number" class="form-control" placeholder="0">
                            </span>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>
@endsection
