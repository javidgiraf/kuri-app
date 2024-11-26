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
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="tbl-accordion-header">
        @foreach($failed_processing_deposit_lists as $failed_processing_deposit)
        <tr id="tb_{{encrypt($failed_processing_deposit->id)}}">
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$failed_processing_deposit->order_id}}</td>
          <td>{{date('d-m-Y', strtotime($failed_processing_deposit->paid_at))}}</td>
          <td>₹ {{number_format($failed_processing_deposit->total_scheme_amount,2)}}</td>
          <td>₹ {{number_format($failed_processing_deposit->service_charge,2)}}</td>
          <td>₹ {{number_format($failed_processing_deposit->gst_charge,2)}}</td>
          <td>₹ {{number_format($failed_processing_deposit->final_amount,2)}}</td>
          <td id="failed_status_{{encrypt($failed_processing_deposit->id)}}">{{$failed_processing_deposit->status!='1'?($failed_processing_deposit->status=='2'?'Failed':'Processing'):''}}</td>
          <td><a data-bs-toggle="modal" class="failed-deposit-model" data-bs-target="#extralargeFailedModal" style="color:blue" order_id="{{encrypt($failed_processing_deposit->order_id)}}">
              <i class="bi bi-eye"></i>
            </a></td>
        </tr>
        @endforeach
      </tbody>
      <div class="modal fade" id="extralargeFailedModal" tabindex="-1">
        <div class="modal-dialog modal-xl fetch-failed-deposit-list">
        </div>
      </div>

    </table>






  </div>
</div>

@push('scripts')
<script>
  $(document).on('click', '.failed-deposit-model', function() {

    var id = $(this).attr('order_id');
    $.ajax({
      url: "{{route('users.fetch-failed-deposit-by-order')}}",
      type: "GET",
      data: {
        order_id: id,
      },
      success: function(response) {

        $('.fetch-failed-deposit-list').html(response.data);


      }
    });
  });


  $(document).on('click', '.btn-failed-process-transaction-save', function(e) {

    e.preventDefault();

    var id = $("#deposit_id").val();
    var tdId = 'failed_status_' + id; // Construct the ID of the td element dynamically
    var tdText = $('#' + tdId).text(); // Get the text content of the td element


    const formData = new FormData($("#frm_process_failed_transation_details")[0]);
    if ($("#failed_process_status").val() == null) {
      $("#frmfailedtrasaction").addClass('alert alert-danger').text("Please Select Status");
      return false;
    }
    $.ajax({
      type: 'POST',
      url: "{{route('users.save-failed-process-status')}}",
      data: formData,
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(xhr) {
        // Show the loader
        $('#process-transaction-loading').show();
        $("#frmfailedtrasaction").removeClass('alert alert-danger');
      },
      success: function(res) {

        if (res.data == '1') {
          $('#process-transaction-loading').hide();
          $("#frmfailedtrasaction").addClass('alert alert-success').text('Status Updated Successfully');
          $('#extralargeFailedModal').modal('hide');
          if ($("#failed_process_status").val() == '1') {
            $('#tb_' + id).remove();
          } else {
            $('#tb_' + id + ' td#failed_status').text('Failed');
            // $('#tb_' + id).find('td#failed_status').text('Failed');

          }
        }

      },
      error: function(data) {
        let err_str = '';
        $('#process-transaction-loading').hide();
        if (data.responseJSON.errors) {
          loading = false;
          $('#loader').html('');
          err_str =
            '<dl class="row"><dt class="col-sm-3"></dt><dt class="col-sm-9"><p><b>Whoops!</b> There were some problems with your input.</p></dt>';
          $.each(data.responseJSON.errors, function(key, val) {
            err_str += '<dt class="col-sm-3">' + key.replace("_",
                " ") + ' </dt><dd class="col-sm-9">' + val +
              '</dd>';
          });
          err_str += '</dl>';
          $('.error_transaction_msg').addClass('alert alert-danger').html(err_str);
          return;
        }
      }
    });
  });
</script>


@endpush