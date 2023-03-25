<div class="row mt-5 container offset-2 ">
    <div class="col-4 mt-5 pt-5">
        <div class="card bg-primary" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Your Direct Referral</h5>
                <h3 class="card-text text-center"><?php if (!isset($directreferral) || $directreferral <= 0) {
                                                        echo 0;
                                                    } else {
                                                        echo $directreferral;
                                                    } ?></h3>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5 pt-5">
        <div class="card bg-info"  style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Your Indirect Referral</h5>
                <h3 class="card-text text-center"><?php if (!isset($indirectreferral) || $indirectreferral <= 0) {
                                                        echo 0;
                                                    } else {
                                                        echo $indirectreferral;
                                                    } ?></h3>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5 pt-5">
        <div class="card bg-warning"  style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Your Total Referral</h5>
                <h3 class="card-text text-center"><?php if (!isset($totalreferral) || $totalreferral <= 0) {
                                                        echo 0;
                                                    } else {
                                                        echo $totalreferral;
                                                    } ?></h3>
            </div>
        </div>
    </div>

</div>

