@extends('layouts.page')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-title d-flex justify-content-between mt-0 m-3">
                        <h5><b>Manage Roles</b></h5>
                        <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i> <span class="text-white">Add Roles</span></a>
                    </div>
                    <div class="card-body">
                        @include('layouts.partials.messages')
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$role->name}}</td>

                                    <td><a href="{{route('roles.edit',$role->id)}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a>
                                        <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $role->id }}').submit();"><i class="bi bi-x-circle"></i></a>
                                    </td>

                                    <form method="post" action="{{route('roles.destroy', $role->id)}}" style="display:none" id="delete-form-{{$role->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </tr>
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