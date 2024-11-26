@extends('layouts.page')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Districts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('districts.index')}}">Districts</a></li>
                <li class="breadcrumb-item active">Update District</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            

                <div class="card">
                    <div class="card-title d-flex justify-content-between m-3 mt-0">
                        <h5><strong>Update</strong> District</h5>
                        <a href="{{route('districts.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
                    </div>
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="{{ route('districts.update', encrypt($district->id)) }}">
                            @csrf
                            @method('patch')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">State <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('state_id') is-invalid @enderror" name="state_id">
                                        <option selected disabled>Select a State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ ($district->state_id == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">District <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id" value="{{ $district->id }}">
                                    <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $district->name) }}" placeholder="Enter New District">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Code <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="title" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $district->code) }}" placeholder="Enter District Code">
                                    @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Status <span class="text-danger">*</span></legend>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="1" {{($district->status=='1'?'checked':'')}}>
                                        <label class="form-check-label" for="gridRadios1">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="0" {{($district->status=='0'?'checked':'')}}>
                                        <label class="form-check-label" for="gridRadios2">
                                            Inactive
                                        </label>
                                    </div>

                                </div>
                            </fieldset>
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

@endsection