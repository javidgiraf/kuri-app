@extends('layouts.page')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Referrel Code Settings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('referrelcodesettings.index')}}">Referrel Code Settings</a></li>
        <li class="breadcrumb-item active">Update Referrel Code Settings</li>
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

          <div class="card-body">
            <h5 class="card-title"><strong>Update</strong> Referrel Code Settings</h5>

            {{-- <div style='text-align: end' ;><a href="{{route('referrelcodesettings.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span>Back</span></a>
          </div><br>--}}
          @include('layouts.partials.messages')
          <!-- General Form Elements -->
          <form method="post" enctype="multipart/form-data" action="{{ route('referrelcodesettings.update', encrypt('1')) }}">
            @csrf
            @method('patch')
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Enter Referrel Code Initial to begin with</label>
              <div class="col-sm-10">
                <input type="text" id="title" name="referrel_code_starts_with" class="form-control" value="{{$referrelcodesettingdata->referrel_code_starts_with}}" placeholder="Refferel Code Begins With">
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
@endsection