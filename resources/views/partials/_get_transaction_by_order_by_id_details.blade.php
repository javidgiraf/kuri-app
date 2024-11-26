<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card sales-card">

                    <div class="card-body" style="padding: 10px;">

                        <div class="ps-3">
                            <dl class="row">
                                <dt class="col-sm-4">User</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['deposit']['subscription']['user']['name']}}</dd>
                                <dt class="col-sm-4">Date</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{date('d-m-Y', strtotime($get_transaction_by_order['deposit']['paid_at']))}}</dd>
                                <dt class="col-sm-4">Scheme</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['deposit']['subscription']['scheme']['title']}}</dd>
                                <dt class="col-sm-4">Order No</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['deposit']['order_id']}}</dd>
                                <dt class="col-sm-4">Transaction No </dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['transaction_no']}}</dd>
                                <dt class="col-sm-4">Payment Method </dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['payment_method']}}</dd>
                                <dt class="col-sm-4">Payment Response </dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['payment_response']}}</dd>
                                <dt class="col-sm-4">Remarks </dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['remark']}}</dd>
                                <dt class="col-sm-4">Final Amount</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7">{{$get_transaction_by_order['paid_amount']}}</dd>

                                <dt class="col-sm-4">Receipt</dt>
                                <dt class="col-sm-1 head">:</dt>
                                <dd class="col-sm-7"><a
                                        href="{{ asset('storage/' . $get_transaction_by_order['upload_file']) }}"
                                        target="_blank"><img
                                            src="{{ asset('storage/' . $get_transaction_by_order['upload_file']) }}"
                                            style="width:10%"></a></dd>



                                <!-- Add more dt/dd pairs as needed -->
                            </dl>

                        </div>
                    </div>

                </div>
            </div><!-- End Sales Card -->

        </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

    </div>
</div>
