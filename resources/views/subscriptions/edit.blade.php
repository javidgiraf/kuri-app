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
  <div class="pagetitle">
    <h1>User Plan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
        <li class="breadcrumb-item active">Update User Plan</li>
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

        <div class="card">
          <div class="card-title d-flex justify-content-between m-3 mt-0">
            <h5><strong>Update</strong> User Plans</h5>
            <a href="{{route('users.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
          </div>
          <div class="card-body">

            <form method="post" enctype="multipart/form-data" action="{{route('subscriptions.update', encrypt($user_subscription->id))}}">
              @csrf
              @method('put')
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Select User</label>
                <div class="col-sm-10">
                  <select name="user_id" class="form-control select2" id="user_id">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{encrypt($user->id)}}" {{$user->id===$user_subscription->user_id?'selected':''}}>{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Select Scheme</label>
                <div class="col-sm-10">
                  <select name="scheme_id" class="form-control select2" id="scheme_id">
                    <option value="">Select Scheme</option>
                    @foreach($schemes as $scheme)
                    <option value="{{encrypt($scheme->id)}}" data-val="{{$scheme->total_period}}" {{$scheme->id===$user_subscription->scheme_id?'selected':''}}>{{$scheme->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Select Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="start_date" id="start_date" value="{{$user_subscription->start_date}}">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Subscribe Amount</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="subscribe_amount" value="{{$user_subscription->subscribe_amount}}">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <div id="enabled">
                    <p>Inactive</p>
                    <label class="switch">
                      <input type="checkbox" name="status" id="togBtn" value="{{$user_subscription->status=='1'?'1':'0'}}" {{$user_subscription->status=='1'?'checked':''}}>
                      <span class="slider"></span>
                    </label>
                    <p>Active</p>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
@push('scripts')

<script type="text/javascript">
  $(document).ready(function() {


    var switchStatus = false;
    $("#togBtn").on('change', function() {
      if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
        $("#togBtn").val('1');
      } else {
        switchStatus = $(this).is(':checked');
        $("#togBtn").val('0');
      }
    });
  });
</script>

@endpush
