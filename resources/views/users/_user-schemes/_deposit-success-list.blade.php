<div class="card">

  <div class="card-body">
    <h5 class="card-title">Successful Deposits</h5>
    <table class="table" id="successful-deposit-list">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Order ID</th>
          <th scope="col">Date</th>
          <th scope="col">Total Scheme Amount</th>
          <th scope="col">Service Charge</th>
          <th scope="col">GST Charge</th>
          <th scope="col">Final Amount</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="tbl-accordion-header">
        @foreach($success_deposit_lists as $success_deposit)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$success_deposit->order_id}}</td>
          <td>{{date('d-m-Y', strtotime($success_deposit->paid_at))}}</td>
          <td>₹ {{number_format($success_deposit->total_scheme_amount,2)}}</td>
          <td>₹ {{number_format($success_deposit->service_charge,2)}}</td>
          <td>₹ {{number_format($success_deposit->gst_charge,2)}}</td>
          <td>₹ {{number_format($success_deposit->final_amount,2)}}</td>
          <td><a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal" style="color:blue" order_id="{{encrypt($success_deposit->order_id)}}">
              <i class="bi bi-eye"></i>
            </a></td>
        </tr>
        @endforeach
      </tbody>
      <div class="modal fade" id="ExtralargeModal" tabindex="-1">
        <div class="modal-dialog modal-xl fetch-success-deposit-list">
        </div>
      </div>

    </table>






  </div>
</div>

@push('scripts')
<script>
  function fetch_transaction_details() {
    var deposit_id = $('#deposit_id').val();
    $.ajax({
      type: 'POST',
      url: "{{route('users.fetch-transaction-details')}}",
      data: {
        'deposit_id': deposit_id
      },
      dataType: 'JSON',
      success: function(res) {

        if (res.data2 != "") {
          $('#enter-trasaction-details').hide();
          $('#fetch-trasaction-details').show();
          $('#fetch-trasaction-details').html(res.data2);
        } else {
          $('#enter-trasaction-details').show();
          $('#fetch-trasaction-details').hide();
        }
      }
    });

  }
  $(document).on('click', '.model', function() {

    var id = $(this).attr('order_id');
    $.ajax({
      url: "{{route('users.fetch-success-deposit-by-order')}}",
      type: "GET",
      data: {
        order_id: id,
      },
      success: function(response) {

        $('.fetch-success-deposit-list').html(response.data);
        fetch_transaction_details();

      }
    });
  });


  $(document).on('click', '.btn-transaction-save', function(e) {
    e.preventDefault();

    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').removeClass('invalid-feedback').text('');

    const formData = new FormData($("#frm_transation_details")[0]);
    if ($("#transaction_no").val() == "") {
      $("#transaction_no").addClass('is-invalid');
      $(".transactionNoError").addClass('invalid-feedback').text("Please enter Transaction No!");
      return false;
    }
    if (!$('#receipt_upload').val()) {
      $("#receipt_upload").addClass('is-invalid');
      $(".receiptUploadError").addClass('invalid-feedback').text("Please upload Receipt!");
      return false;
    }
    $.ajax({
      type: 'POST',
      url: "{{route('users.save-transaction-details')}}",
      data: formData,
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(xhr) {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').removeClass('invalid-feedback').text('');
      },
      success: function(res) {
        $('#transaction-loading').hide();
        $("#frmtrasaction").addClass('alert alert-success').text('Transaction details saved successfully');
        $("#frm_transation_details")[0].reset();
        if (res.data2 != "") {
          $('#enter-trasaction-details').hide();
          $('#fetch-trasaction-details').show();
          $('#fetch-trasaction-details').html(res.data2);
        } else {
          $('#enter-trasaction-details').show();
          $('#fetch-trasaction-details').hide();
        }



      },
      error: function(data) {
        if (data.responseJSON.errors.transaction_no) {
          $("#transaction_no").addClass('is-invalid');
          $(".transactionNoError").addClass('invalid-feedback').text(data.responseJSON.errors.transaction_no[0]);
        }

        if (data.responseJSON.errors.receipt_upload) {
          $("#receipt_upload").addClass('is-invalid');
          $(".receiptUploadError").addClass('invalid-feedback').text(data.responseJSON.errors.receipt_upload[0]);
        }
      }
    });
  });
</script>


@endpush