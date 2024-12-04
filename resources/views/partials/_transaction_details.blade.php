<h5 class="card-title" style="text-align: left;">Transaction Details</h5>
<div class="ps-3">
    <dl class="row">
        <dt class="col-sm-2">Transaction No </dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-9">{{ $transactionDetails['transaction_no'] }}</dd>

        <dt class="col-sm-2">Receipt</dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-9"><a href="{{ asset('storage/' . $transactionDetails['upload_file']) }}" target="_blank"><img src="{{ asset('storage/' . $transactionDetails['upload_file']) }}" style="width:10%"></a></dd>

        <dt class="col-sm-2">Remark</dt>
        <dt class="col-sm-1 head">:</dt>
        <dd class="col-sm-9">{{ $transactionDetails['remark'] }}</dd>


        <!-- Add more dt/dd pairs as needed -->
    </dl>

</div