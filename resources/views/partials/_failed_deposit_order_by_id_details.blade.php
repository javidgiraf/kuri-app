<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>

    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-xxl-6 col-md-6">
        <div class="card info-card sales-card">

          <div class="card-body" style="padding: 10px;">

            <div class="ps-3">
              <dl class="row">
                <dt class="col-sm-5">Order Id</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5"> {{$failed_deposit_by_order['order_id']}}</dd>

                <dt class="col-sm-5">Date</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">{{date('d-m-Y', strtotime($failed_deposit_by_order['paid_at']))}}</dd>

                <dt class="col-sm-5">Total Scheme Amount</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">₹ {{number_format($failed_deposit_by_order['total_scheme_amount'],2)}}</dd>
                <dt class="col-sm-5">User Type</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">{{$failed_deposit_by_order['user_type']=='admin'?'Admin':'Customer'}}</dd>

                <!-- Add more dt/dd pairs as needed -->
              </dl>

            </div>
          </div>

        </div>
      </div><!-- End Sales Card -->
      <div class="col-xxl-6 col-md-6">
        <div class="card info-card sales-card">

          <div class="card-body" style="padding: 10px;">

            <div class="ps-3">
              <dl class="row">
                <dt class="col-sm-5">Service Charge</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">₹ {{number_format($failed_deposit_by_order['service_charge'],2)}}</dd>

                <dt class="col-sm-5">GST Charge</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">₹ {{number_format($failed_deposit_by_order['gst_charge'],2)}}</dd>

                <dt class="col-sm-5">Final Amount</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">₹ {{number_format($failed_deposit_by_order['final_amount'],2)}}</dd>

                <dt class="col-sm-5">Payment Type</dt>
                <dt class="col-sm-1 head">:</dt>
                <dd class="col-sm-5">{{$failed_deposit_by_order['payment_type']}}</dd>

                <!-- Add more dt/dd pairs as needed -->
              </dl>

            </div>
          </div>

        </div>
      </div><!-- End Sales Card -->
    </div>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Amount</th>
        <th scope="col">Due Status</th>
        <th scope="col">Status</th>

      </tr>
    </thead>
    <tbody>
      @foreach($failed_deposit_by_order['deposit_periods'] as $deposit_period)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{date('d-m-Y', strtotime($deposit_period['due_date']))}}</td>
        <td>{{$deposit_period['scheme_amount']}}</td>
        <td>{{$deposit_period['status']==1?($deposit_period['is_due']=='1'?'Payment is Delayed':'Payment on time'):''}}</td>
        <td>{{$deposit_period['status']=='0'?'Payment Processed':'Payment Failed'}}</td>

      </tr>
      @endforeach
    </tbody>

  </table>
  @if($failed_deposit_by_order['status']!='2')

  <div class="card-body" id="failed-process-status-update" style="display:none">
    <h5 class="card-title" style="text-align: left;">Change the Status</h5>
    <div id="frmfailedtrasaction"></div>

    <!-- Horizontal Form -->
    <form id="frm_process_failed_transation_details">
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Change the status</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="deposit_id" name="deposit_id" value="{{$failed_deposit_by_order['id']}}">

          <select class="form-select" id="failed_process_status" name="failed_process_status">
            <option value="" selected disabled>Select the Status</option>
            <option value="1">Success</option>
            <option value="2">Fail</option>
          </select>
        </div>
      </div>


      <div class="col-md-12" id="process-transaction-loading" style="text-align: center;display:none">
        <img src="{{asset('assets/img/loading.gif')}}" style="width: 25%;">
      </div>

      <div class="text-center">
        <button type="button" class="btn btn-primary btn-failed-process-transaction-save">Submit</button>

      </div>
    </form><!-- End Horizontal Form -->

  </div>

  @endif

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

  </div>
</div>