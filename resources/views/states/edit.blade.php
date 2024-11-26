@extends('layouts.page')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>States</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('states.index')}}">States</a></li>
                <li class="breadcrumb-item active">Update State</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                

                <div class="card">
                    <div class="card-title d-flex justify-content-between m-3 mt-0">
                        <h5><strong>Update</strong> State</h5>
                        <a href="{{route('states.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span class="text-white">Back</span></a>
                    </div>
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="{{ route('states.update', encrypt($state->id)) }}">
                            @csrf
                            @method('patch')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Country <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('country_id') is-invalid @enderror" name="country_id">
                                        <option selected disabled>Select a Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ ($state->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">State <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id" value="{{ $state->id }}">
                                    <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $state->name) }}" placeholder="Enter New State">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Code <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="title" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $state->code) }}" placeholder="Enter State Code">
                                    @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Status <span class="text-danger">*</span></legend>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="1" {{($state->status=='1'?'checked':'')}}>
                                        <label class="form-check-label" for="gridRadios1">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="0" {{($state->status=='0'?'checked':'')}}>
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