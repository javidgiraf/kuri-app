<div class="ps-3">
    <dl class="row">
        <dt class="col-sm-5">Final Amount </dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-5">₹ {{number_format($discontinued_details['final_amount'],2)}}</dd>

        <dt class="col-sm-5">Settlement Amount</dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-5">₹ {{number_format($discontinued_details['settlement_amount'],2)}}</dd>

        <dt class="col-sm-5">Date</dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-5">{{date('d-m-Y',strtotime($discontinued_details['paid_on']))}}</dd>

        <dt class="col-sm-5">Reason</dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-5">{{ $discontinued_details['reason'] }}</dd>


        <!-- Add more dt/dd pairs as needed -->
    </dl>

</div>