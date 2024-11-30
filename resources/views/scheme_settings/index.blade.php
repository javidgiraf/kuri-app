@extends('layouts.page')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Scheme Settings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Scheme Settings</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">


      <div class="col-lg-12">

        <div class="card">
          <div class="card-title d-flex justify-content-between m-3 mt-0">
            <h5><b>Manage Scheme Settings</b></h5>
            <a href="{{route('scheme-settings.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i> <span class="text-white">Add Scheme Setting</span></a>
          </div>
          <div class="card-body">

            @include('layouts.partials.messages')
            <!-- Table with stripped rows -->
            <table class="table table-striped">
          
              <thead>
                <tr>
                  <th>No</th>
                  <th scope="col">Max Payable Amount</th>
                  <th scope="col">Min Payable Amount</th>
                  <th scope="col">Denomination</th>
                  <th scope="col">Due Duration</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($schemeSettings as $setting)
                <tr>
                  <td>{{ $loop->iteration + ($schemeSettings->currentPage() - 1) * $schemeSettings->perPage() }}</td>
                  <td>{{ $setting->max_payable_amount }}</td>
                  <td>{{ $setting->min_payable_amount }}</td>
                  <td>{{ $setting->denomination }}</td>
                  <td>{{ $setting->due_duration }}</td>
                  <td>{{ ($setting->status == true) ? __('Active') : __('Inactive') }}</td>
                  <td>
                    <a href="{{route('scheme-settings.edit',$setting->id)}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a>
                      
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $schemeSettings->onEachSide(5)->links() }}
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
    function deleteSchemeSetting(id) {

        swal({
                title: "Are you sure ?",
                text: "Do you want to delete this Scheme Setting ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
    }
</script>
@endpush