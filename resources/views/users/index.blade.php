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
                        <h5><b>Manage Users</b></h5>
                        <a href="{{route('users.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i> <span class="text-white">Create User</span></a>
                    </div>
                    <div class="card-body table-responsive">

                        @include('layouts.partials.messages')
                        <!-- Table with stripped rows -->
                        <table class="table table-striped" style="width: 120%;">
                        
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Verification Status</th>
                                    <th scope="col">Profile Completion Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{isset($user->customer)?$user->customer->mobile:''}}</td>
                                    <td><span {{isset($user->customer)?($user->customer->is_verified=='1'?  'class=active':'class=inactive'):'class=inactive'}}>{{isset($user->customer)?($user->customer->is_verified=='1'?'Verified':'Not Verified'):'Not Verified'}} </span></td>
                                    <td>
                                        @if(isset($user->address)||isset($user->nominee))
                                        @if($user->customer->aadhar_number!=""||$user->customer->mobile!=""||$user->address->address!=""||$user->address->district_id !=""||$user->address->state_id!=""||$user->address->country_id!=""||$user->nominee->name!=""||$user->nominee->relationship!="")
                                        <span class="active">Completed</span>
                                        @else
                                        <span class="inactive">Not completed</span>
                                        @endif
                                        @else
                                        <span class="inactive">Not completed</span>
                                        @endif



                                    </td>
                                    <td id="status{{$user->id}}"><span {{isset($user->customer)?($user->customer->status=='1'?  'class=active':'class=inactive'):'class=inactive'}}>{{isset($user->customer)?($user->customer->status=='1'?'Active':'Not Active'):'Not Active'}}</span><span style="padding-left: 4px;"> <a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal{{$user->id}}" style="color:blue">
                                                <i class="bi bi-pencil-square"></i></a></span></td>

                                    <td><a href="{{route('users.edit',encrypt($user->id))}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a>
                                        <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $user->id }}').submit();"><i class="bi bi-x-circle"></i></a>
                                    </td>
                                    <form method="post" action="{{route('users.destroy', encrypt($user->id))}}" style="display:none" id="delete-form-{{$user->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </tr>
                                <div class="modal fade" id="ExtralargeModal{{$user->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="exampleModalLabel">Change Status of the User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-12">
                                                        <div class="success"></div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Status</label>
                                                        <div class="col-sm-10">
                                                            <div id="enabled">
                                                                <p>Inactive</p>
                                                                <label class="switch">
                                                                  <input type="checkbox"
                                                                         id="togBtn{{$user->id}}"
                                                                         data-id="{{$user->id}}"
                                                                         class="togBtn"
                                                                         name="status"
                                                                         value="{{ optional($user->customer)->status == 1 ? '1' : '' }}"
                                                                         {{ optional($user->customer)->status == 1 ? 'checked' : '' }}>

                                                                    <span class=" slider"></span>
                                                                </label>
                                                                <p>Active</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary btn-change-status" id="{{$user->id}}">Save changes</button>
                                                    <div class="col-md-12" id="loading{{$user->id}}" style="text-align: center;display:none">
                                                        <img src="{{asset('assets/img/loading.gif')}}" style="width: 13%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
