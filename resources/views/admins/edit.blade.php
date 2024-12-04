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
    <h1>Admin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admins</a></li>
        <li class="breadcrumb-item active">Update Admin</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-title d-flex justify-content-between m-3 mt-0">
            <h5><strong>Update</strong> Admin</h5>
            <a href="{{ route('admins.index') }}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
          </div>
          <div class="card-body">

            <form method="post" action="{{ route('admins.update', encrypt($admin->id)) }}">
              @csrf
              @method('patch')

              <div class="row mb-3">
                <input type="hidden" name="id" value="{{ $admin->id }}">
                <label for="inputText" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" placeholder="Enter Name" autocomplete="one-time-code">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" placeholder="Enter Email" autocomplete="one-time-code">
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            
              <div class="row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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

<script>
  function getDistrictsonload(state_id, district_id) {
    $.ajax({
      url: "{{route('states.get-districts')}}",
      type: "GET",
      data: {
        state_id: state_id,
        district_id: district_id,
      },
      success: function(response2) {
        $('#district_id').html(response2.data);

      },
    });
  }

  $(document).ready(function() {
    var country_id = $('#country_id').val();
    var state_id = "{{ isset($user->address->state_id) ? $user->address->state_id : '' }}";
    var district_id = "{{ isset($user->address->district_id) ? $user->address->district_id : '' }}";


    $.ajax({
      url: "{{ route('countries.get-states') }}",
      type: "GET",
      data: {
        country_id: country_id,
        state_id: state_id,
        district_id: district_id
      },
      success: function(response) {

        $('#state_id').html(response.data);
        getDistrictsonload(state_id, district_id);
      }
    });

    $('#state_id').change(function() {
      var state_id = $(this).val();
      var district_id = "";
      getDistrictsonload(state_id, district_id);

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
  });
</script>
@endpush