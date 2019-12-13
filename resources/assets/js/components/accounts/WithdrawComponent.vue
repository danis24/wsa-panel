<template>
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
</template>

<script>
export default {

}
</script>
