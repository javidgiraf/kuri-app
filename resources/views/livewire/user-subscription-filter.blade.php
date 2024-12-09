<section class="section">
    <div class="row">


        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Manage Users Subscriptions</h5>
                    @include('layouts.partials.messages')
                    <!-- Table with stripped rows -->

                    <style>
                        .md {
                            margin-bottom: 25px;
                        }

                        .fixed-left {
                            position: sticky;
                            left: 0;
                            background-color: #ffffff;
                            z-index: 1;
                        }

                        @media (max-width: 768px) {
                            .fixed-left {
                                position: static;
                                z-index: auto;
                            }
                        }
                    </style>
                    <div class="row md">
                        <div class="col-md-3">
                            <div wire:ignore>
                                <select wire:model="user_id" class="form-control" wire:change="user_table_filer" id="user_id">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                    <option <?= request('user_id') == $user->id ? 'selected' : '' ?> value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div wire:ignore>
                                <select wire:model="scheme_id" class="form-control" wire:change="scheme_table_filer" id="scheme_id">
                                    <option value="">Select scheme</option>
                                    @foreach($schemes as $scheme)
                                    <option <?= request('scheme_id') == $scheme->id ? 'selected' : '' ?> value="{{$scheme->id}}">{{$scheme->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div wire:ignore>
                                <select wire:model="mature_status" class="form-control" wire:change="mature_status_table_filer" id="mature_status">
                                    <option value="">Select Maturity Status</option>
                                    <option value="1">Closed</option>
                                    <option value="0">Open</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div wire:ignore>
                                <select wire:model="scheme_status" class="form-control" wire:change="scheme_status_table_filer" id="scheme_status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">In active</option>
                                    <option value="2">Discontinue</option>
                                    <option value="3">Oh Hold</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row md">

                        <div class="col-md-3">
                            <input type="date" wire:model="from_date" class="date form-control" id="from_date" wire:change="date_id_filer">
                        </div>
                        <div class=" col-md-3">
                            <input type="date" wire:model="to_date" class="date form-control" id="to_date" wire:change="date_id_filer">
                        </div>
                        
                        <div class="col-md-3">
                            <button wire:click="resetOnClick" class="btn btn-primary" id="reset">Reset</button>
                        </div>

                        @can(['subscriptionsExport'])
                        <div class="col-md-3">
                            <a class="btn btn-success btnExport" onclick="updateExportUrl();">Export To Excel</a>
                        </div>
                        @endcan
                    </div>

                   
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" style="width: 120%;">
                            {{-- <div style='text-align: end' ;><a href="{{route('districts.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i><span>Add District</span></a>
                    </div> --}}

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="10%">User</th>
                            <th scope="col">Scheme</th>
                            <th scope="col">Scheme Amount</th>
                            <th scope="col">Collected Amount</th>
                            <th scope="col">State Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Closing Status</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="fixed-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userSubscriptions as $userSubscription)
                        <tr>
                            <th scope="row">{{ $userSubscriptions->firstitem() + $loop->index }}</th>
                            <td>{{$userSubscription->user?->name}}</td>
                            <td>{{$userSubscription->scheme?->title}}</td>

                            <td>{{ \App\Models\Setting::CURRENCY }} {{ number_format($userSubscription->subscribe_amount, 2) }}</td>
                            <td>
                                @php $totalAmount = 0; @endphp
                                @foreach($userSubscription->deposits as $deposit)
                                @if($deposit->status=='1')
                                @php $totalAmount += $deposit->final_amount @endphp
                                @endif
                                @endforeach
                                {{ \App\Models\Setting::CURRENCY }} {{ number_format($totalAmount, 2) }}
                            </td>
                            <td>{{date('d-m-Y', strtotime($userSubscription->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($userSubscription->end_date))}}</td>
                            <td>{{$userSubscription->is_closed=='0'?"Open":"Closed"}}</td>
                            @if($userSubscription->status=='1')
                            <td>Active</td>
                            @elseif($userSubscription->status=='2')
                            <td>Discontinued</td>
                            @elseif($userSubscription->status=='3')
                            <td>On Hold</td>
                            @else
                            <td>De Active</td>
                            @endif


                            <td class="fixed-left">
                                {{--<a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal" style="color:blue" id="{{encrypt($userSubscription->id)}}" user_id="{{encrypt($userSubscription->user?->id)}}" scheme_id="{{encrypt($userSubscription->scheme?->id)}}">
                                <i class="bi bi-eye"></i>
                                </a>--}}

                                <a href="{{route('users.edit-scheme-details',[encrypt($userSubscription->id),encrypt($userSubscription->user?->id),encrypt($userSubscription->scheme?->id)])}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a>
                                {{-- <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $district->id }}').submit();"><i class="bi bi-x-circle"></i></a> --}}
                            </td>

                            {{-- <form method="post" action="{{route('districts.destroy', encrypt($district->id))}}" style="display:none" id="delete-form-{{$district->id}}">
                            @csrf
                            @method('DELETE')
                            </form> --}}

                        </tr>
                        @endforeach
                        <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                            <div class="modal-dialog modal-xl fetch-list">


                            </div>
                        </div>
                    </tbody>
                    </table>

                    {{ $userSubscriptions->links() }}
                </div>
                <!-- End Table with stripped rows -->

            </div>
        </div>







    </div>
    </div>
</section>
@push('scripts')
<script>
    let baseUrl = "{{ route('users.get-user-subscriptions') }}";
    let exportUrl = "{{ route('subscriptionsExport') }}";

    function updateExportUrl() {
        // Collect filter values
        var user_id = $('#user_id').val();
        var scheme_id = $('#scheme_id').val();
        var mature_status = $('#mature_status').val();
        var scheme_status = $('#scheme_status').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        // Construct query parameters
        var queryParams = [];
        if (user_id) queryParams.push('user_id=' + user_id);
        if (scheme_id) queryParams.push('scheme_id=' + scheme_id);
        if (mature_status) queryParams.push('mature_status=' + mature_status);
        if (scheme_status) queryParams.push('scheme_status=' + scheme_status);
        if (from_date) queryParams.push('from_date=' + from_date);
        if (to_date) queryParams.push('to_date=' + to_date);

        // Update export button URL
        let newExportUrl = exportUrl + (queryParams.length ? '?' + queryParams.join('&') : '');
        $('.btnExport').attr('href', newExportUrl);
    }

    function updateUrlAndLivewire(property, value) {
        @this.set(property, value);
        updateExportUrl();
    }

    $('#user_id').on('change', function() {
        updateUrlAndLivewire('user_id', $(this).val());
    });

    $('#scheme_id').on('change', function() {
        updateUrlAndLivewire('scheme_id', $(this).val());
    });

    $('#mature_status').on('change', function() {
        updateUrlAndLivewire('mature_status', $(this).val());
    });

    $('#scheme_status').on('change', function() {
        updateUrlAndLivewire('scheme_status', $(this).val());
    });

    $('#from_date, #to_date').on('change', function() {
        updateUrlAndLivewire('from_date', $('#from_date').val());
        updateUrlAndLivewire('to_date', $('#to_date').val());
    });

    $(document).on('click', '.model', function() {
        var id = $(this).attr('id');
        var user_id = $(this).attr('user_id');
        var scheme_id = $(this).attr('scheme_id');

        $.ajax({
            url: "{{route('users.current-plan-history')}}",
            type: "GET",
            data: {
                user_subscription_id: id,
                user_id: user_id,
                scheme_id: scheme_id
            },
            success: function(response) {

                $('.fetch-list').html(response.data);

            }
        });
    });
</script>
@endpush