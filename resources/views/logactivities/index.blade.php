@extends('layouts.page')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>User Log Activities</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Countries</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">


      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title">List User Log Activities</h5>
            @include('layouts.partials.messages')
            <!-- Table with stripped rows -->
            <table class="table table-striped">
              {{-- <div style='text-align: end' ;><a href="{{route('countries.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i><span>Add Countries</span></a>
          </div>--}}
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Action</th>
              <th scope="col">User</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>

            </tr>
          </thead>
          <tbody>
            @foreach($logactivities as $logactivity)
            <tr>
              <th scope="row">{{ $logactivities->firstitem() + $loop->index }}</th>
              <td>{{$logactivity->subject}}</td>
              <td>{{ ($logactivity->user) ? $logactivity->user->name : '' }}</td>
              <td>{{date('d-m-Y', strtotime($logactivity->created_at))}}</td>
              <td>{{date('h:i A', strtotime($logactivity->created_at))}}</td>

              {{-- <td>
            <a href="{{route('countries.edit',encrypt($country->id))}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a>
              <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $country->id }}').submit();"><i class="bi bi-x-circle"></i></a>
              </td> --}}

              {{--<form method="post" action="{{route('countries.destroy', encrypt($country->id))}}" style="display:none" id="delete-form-{{$country->id}}">
              @csrf
              @method('DELETE')
              </form>--}}

            </tr>
            @endforeach

          </tbody>
          </table>

          {{ $logactivities->onEachSide(5)->links() }}
          <!-- End Table with stripped rows -->

        </div>
      </div>







    </div>
    </div>
  </section>

</main>
@endsection