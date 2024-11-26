@extends('layouts.page')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}">
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"> Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">Create Permission</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
    

                <div class="card">
                    <div class="card-title d-flex justify-content-between m-3 mt-0">
                        <h5><strong>Add</strong> New Permission</h5>
                        <a href="{{route('permissions.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
                    </div>
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="{{route('permissions.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Permission <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter New permission">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
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
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}">
</script>

@endpush
@endsection