<template>
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
                    <td>danis1 <div class="badge badge-warning badge-md">Loaded</div>
                    </td>
                    <td class="pull-right" width="30%">
                        <button class="btn btn-pill btn-danger" type="button" id="delete"><i class="fe fe-trash"></i></button>
                        <button class="btn btn-pill btn-success" type="button" id="load"><i class="fe fe-refresh-cw"></i></button>
                    </td>
                </tr>
                <tr class="alert alert-success mb-0">
                    <th scope="row" width="5%">1</th>
                    <th scope="row" width="5%">514515145411</th>
                    <td>danis2</td>
                    <td class="pull-right" width="30%">
                        <button class="btn btn-pill btn-danger" type="button" id="delete"><i class="fe fe-trash"></i></button>
                        <button class="btn btn-pill btn-success" type="button" id="load"><i class="fe fe-refresh-cw"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {

}
</script>
