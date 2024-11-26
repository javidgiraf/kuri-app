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
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
        <li class="breadcrumb-item active">Add User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
      

        <div class="card">
          <div class="card-title d-flex justify-content-between m-3 mt-0">
            <h5><strong>Add</strong> New User</h5>
            <a href="{{route('users.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
          </div>
          <div class="card-body">

            <form method="post" enctype="multipart/form-data" action="{{route('users.store')}}">
              @csrf
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Name" autocomplete="one-time-code">
                  @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="email" id="title" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="one-time-code">
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Mobile <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" id="title" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" placeholder="Enter Mobile Number" autocomplete="one-time-code">
                  @error('mobile')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" autocomplete="one-time-code">
                  @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password" autocomplete="new-password">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Referrel Code <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" id="referrel_code" name="referrel_code" class="form-control @error('referrel_code') is-invalid @enderror" value="{{ old('referrel_code') }}" placeholder="Enter Referrel Code" autocomplete="one-time-code" readonly>
                  @error('referrel_code')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <div id="enabled">
                    <p>Inactive</p>
                    <label class="switch">
                      <input type="checkbox" name="status" id="togBtn">
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
    $("#togBtn").val('1');
    $("#togBtn").prop('checked', true);

    $.ajax({
      url: "{{route('users.generate-random-number')}}",
      type: "GET",

      success: function(response) {

        $('#referrel_code').val(response.data);

      }
    });
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
  })
</script>

@endpush