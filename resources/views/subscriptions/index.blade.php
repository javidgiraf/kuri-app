@extends('layouts.page')
@push('styles')
<style>
  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  p {
    display: inline-block;
    vertical-align: middle;
    padding-top: 5px;
    padding-right: 5px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
</style>
@endpush
@section('content')
<main id="main" class="main">
  <style>
    span.active {
      color: white;
      background-color: green;
      padding: 5px;
      font-size: 12px;
    }

    span.inactive {
      color: white;
      background-color: red;
      padding: 5px;
      font-size: 12px;
    }

    .modal {

      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;

    }
  </style>
  <div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">


      <div class="col-lg-12">

        <div class="card">
          <div class="card-title d-flex justify-content-between m-3 mt-0">
            <h5><b>Manage Users Plan</b></h5>
            <a href="{{route('subscriptions.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i> <span class="text-white">Create User Plan</span></a>
          </div>
          <div class="card-body">

            @include('layouts.partials.messages')
            <!-- Table with stripped rows -->
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Scheme</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Is Closed</th>
                  <th scope="col">Status</th>
                  <!--<th scope="col">Action</th>-->
                </tr>
              </thead>
              <tbody>
                @foreach($userSubscriptions as $user)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ optional($user->user)->name }}</td>

                  <td>{{ ($user->scheme) ? $user->scheme->title : '' }}</td>
                  <td>{{date('d-m-Y', strtotime($user->start_date))}}</td>
                  <td>{{date('d-m-Y', strtotime($user->end_date))}}</td>
                  <td>
                    @if($user->is_closed==1)
                    <span class="active">Active</span>
                    @else
                    <span class="inactive">Inactive</span>
                    @endif
                  </td>
                  <td>
                    @if($user->status==1)
                    <span class="active">Active</span>
                    @else
                    <span class="inactive">Inactive</span>
                    @endif
                  </td>
                  <!-- <td>
                    <a href="{{route('subscriptions.edit', encrypt($user->id))}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                  </td> -->

                </tr>

                @endforeach

              </tbody>

            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>







      </div>
    </div>
  </section>

</main>
@endsection
@push('scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var $modal = $('.modal');

  //when hidden
  $modal.on('hidden.bs.modal', function(e) {
    $('.success').removeClass('alert alert-success').html('');
  });

  var switchStatus = false;
  $(".togBtn").on('change', function() {
    var id = $(this).attr('data-id');

    if ($(this).is(':checked')) {
      switchStatus = $(this).is(':checked');
      $("#togBtn" + id).val('1');
    } else {
      switchStatus = $(this).is(':checked');
      $("#togBtn" + id).val('0');
    }
  });
  $('.btn-change-status').on('click', function() {
    var id = $(this).attr('id');
    var switchToggle = $('#togBtn' + id).val();
    $.ajax({
      //  url: "{{route('users.update-plan-status')}}", // URL to your Laravel route
      url: "{{route('users.change-status')}}", // URL to your Laravel route
      type: 'POST',
      data: {
        user_id: id,
        status: switchToggle,

      }, // Pass the serialized data
      dataType: 'json',
      beforeSend: function(xhr) {
        $('#loading' + id).show();
        $('.success').removeClass('alert alert-success').html('');

      },
      success: function(response) {
        $('#loading' + id).hide();
        if (switchToggle == '1') {
          ($('#status' + id).html('<span class="active">Active</span><span style="padding-left: 9px;"><a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal' + id + '" style="color:blue"><i class ="bi bi-pencil-square"></i></a></span>'));
        } else {
          ($('#status' + id).html('<span class="inactive">Not Active</span><span style="padding-left: 9px;"><a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal' + id + '" style="color:blue"><i class ="bi bi-pencil-square"></i></a></span>'));

        }
        // $('.modal').modal('hide');
        $('.success').addClass('alert alert-success').html('Status Updated Successfully');

      }
    });




  });
</script>
@endpush