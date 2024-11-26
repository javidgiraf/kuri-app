@extends('layouts.page')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/dropify/css/dropify.min.css')}}">
<link href="{{asset('assets/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                <li class="breadcrumb-item active">Add Role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            

                <div class="card">
                    <div class="card-title d-flex justify-content-between m-3 mt-0">
                        <h5><strong>Add</strong> New Role</h5>
                        <a href="{{route('roles.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
                    </div>
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="{{route('roles.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Role" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-12">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Assign Permissions</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <th scope="col" width="1%"><input type="checkbox" name="all_permission" class="all_permission @error('permission') is-invalid @enderror"></th>
                                                <th scope="col" width="20%">Name</th>
                                                <th scope="col" width="1%">Guard</th>
                                            </thead>

                                            @foreach($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission '>
                                                </td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('[name="all_permission"]').on('click', function() {

            if ($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked', true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked', false);
                });
            }

        });
    });
</script>
@endpush
@endsection