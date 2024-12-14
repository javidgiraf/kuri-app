@extends('layouts.page')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Subscription</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Customers</a></li>
        <li class="breadcrumb-item active">Update Customer Subscription</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <style>
          .head {
            text-align: end;
          }

          .card-title {
            text-align: center;
          }

          .card-tt {
            text-align: center;
          }
        </style>
      
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="home-tab" data-id="subscriptionHistory" data-bs-toggle="tab" data-bs-target="#subscription-history" type="button" role="tab" aria-controls="subscription-history" aria-selected="true">Subscription History</button>
              </li>
              <!-- <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="profile-tab" data-id="upaidList" data-bs-toggle="tab" data-bs-target="#unpaid-list" type="button" role="tab" aria-controls="upaid-list" aria-selected="false">Unpaid List</button>
              </li> -->
              <!--  <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="contact-tab" data-id="depositSuccessList" data-bs-toggle="tab" data-bs-target="#deposit-success-list" type="button" role="tab" aria-controls="deposit-success-list" aria-selected="false">Successful Orders</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="contact-tab" data-id="failedorprocessingList" data-bs-toggle="tab" data-bs-target="#failed-or-processing-list" type="button" role="tab" aria-controls="failed-or-processing-list" aria-selected="false">Failed/Processing Orders</button>
              </li> -->
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="contact-tab" data-id="changeStatus" data-bs-toggle="tab" data-bs-target="#change-status" type="button" role="tab" aria-controls="change-status" aria-selected="false">Change Status</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="subscription-history" role="tabpanel" aria-labelledby="subscription-list-tab">
                @include('users._user-schemes._subscription-history')
              </div>
              <div class="tab-pane fade" id="unpaid-list" role="tabpanel" aria-labelledby="unpaid-list-tab">
                @include('users._user-schemes._unpaid-list')
              </div>
              <div class="tab-pane fade" id="deposit-success-list" role="tabpanel" aria-labelledby="deposit-success-list-tab">
                @include('users._user-schemes._deposit-success-list')
              </div>
              <div class="tab-pane fade" id="failed-or-processing-list" role="tabpanel" aria-labelledby="failed-or-processing-list-tab">
                @include('users._user-schemes._failed-or-processing-list')
              </div>
              <div class="tab-pane fade" id="change-status" role="tabpanel" aria-labelledby="change-status-tab">
                @include('users._user-schemes._change-status')
              </div>
            </div><!-- End Default Tabs -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
@push('scripts')

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function subscriptionHistory() {
    $('#subscription-history tbody').empty();
    $.ajax({
      url: '{{ route("users.current-plan-history") }}', // URL to your Laravel route
      type: 'GET',
      data: {
        user_subscription_id: "{{encrypt($user_subscription_id)}}",
        user_id: "{{encrypt($user_id)}}",
        scheme_id: "{{encrypt($scheme_id)}}",

      }, // Pass the serialized data
      dataType: 'json',
      success: function(response) {

        $('#subscription-history tbody').append(response.data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });

  }

  function upaidList() {
    $('#upaid-list tbody').empty();
    $.ajax({
      url: '{{ route("users.unpaid-list") }}', // URL to your Laravel route
      type: 'GET',
      data: {
        user_subscription_id: "{{encrypt($user_subscription_id)}}",
        user_id: "{{encrypt($user_id)}}",
        scheme_id: "{{encrypt($scheme_id)}}",

      }, // Pass the serialized data
      dataType: 'json',
      success: function(response) {

        $('#upaid-list tbody').append(response.data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }

  function changeStatus() {
    $('#discontinue-details').hide();
    $('#maturity-status-success-box').hide();
    $('#scheme-status-success-box').hide();
    $('.error_transaction_msg').removeClass('alert alert-danger').html('');
    $("#frmtrasaction").removeClass('alert alert-danger').html('');
    $.ajax({
      url: "{{route('users.get-plan-status')}}", // URL to your Laravel route
      type: 'GET',
      data: {
        subscription_id: "{{encrypt($user_subscription_id)}}",
      }, // Pass the serialized data
      dataType: 'json',

      success: function(response) {
        if (response.maturity_status == '1') {
          $('#mat_status').html("");
          $('#maturity-status-box').hide();
          $('#maturity-status-success-box').show();
          $('#mat_status').html("Closed");
        }
        if (response.scheme_status == '2') {
          $('#sub_status').html("");
          $('#scheme-status-box').hide();
          $('#scheme-status-success-box').show();
          $('#discontinue-details-details').html(response.discontinued_details);
          $('#sub_status').html("Discontinued");

        } else {

          if (response.scheme_status == '1') {
            $('#sub_status').html("");
            $('#sub_status').html("Active");
          }
          if (response.scheme_status == '0') {
            $('#sub_status').html("");
            $('#sub_status').html("In Active");
          }
          if (response.scheme_status == '3') {
            $('#sub_status').html("");
            $('#sub_status').html("On Hold");
          }
          $("#scheme_status").val(response.scheme_status).change();
        }
        if (response.scheme_status == '2' && response.maturity_status == '1') {
          $('#btn-update').prop('disabled', true);
        } else {
          $('#btn-update').prop('disabled', false);
        }
      }
    });

  }



  $('document').ready(function() {

    var ref_this = $('.nav-link.active');
    functionName = ref_this.attr('data-id');
    window[functionName]();

    $(".nav-link").click(function() {
      $('#discontinue-details').hide();
      $('.success').removeClass('alert alert-success').html('');
      $('#scheme_staus').hide();
      $(".nav-link.active").removeClass("active");
      $(this).addClass("active");
      var ref_this = $('.nav-link.active');
      functionName = ref_this.attr('data-id');
      window[functionName]();
    });
    // alert("hello");
  });
</script>
@endpush
