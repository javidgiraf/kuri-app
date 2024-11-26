@extends('layouts.page')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Permissions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-title d-flex justify-content-between m-3 mt-0">
                        <h5><b>Manage Permissions</b></h5>
                        <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i> <span class="text-white">Add Permissions</span></a>
                    </div>
                    <div class="card-body">
                        @include('layouts.partials.messages')

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Name</th>
                                    <th>Guard</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th>{{$permission->name}}</th>
                                    <td>{{$permission->guard_name}}</td>

                                    <td><a href="{{route('permissions.edit',$permission->id)}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a><a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $permission->id }}').submit();"><i class="bi bi-x-circle"></i></a></td>
                                    <form method="post" action="{{route('permissions.destroy', $permission->id)}}" style="display:none" id="delete-form-{{$permission->id}}">
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