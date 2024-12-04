<section class="section">
    <div class="row">


        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Manage Transaction details

                    </h5>
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
                                    <option value="" selected disabled>Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div wire:ignore>
                        <select wire:model="scheme_id" class="form-control" id="scheme_id">
                            <option value="">Select scheme</option>
                            @foreach($schemes as $scheme)
                            <option value="{{$scheme->id}}">{{$scheme->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               {{-- <div class="col-md-3">
                    <div wire:ignore>
                        <select wire:model="status" class="form-control" id="status">
                            <option value="">Select Status</option>
                            <option value="1">Success</option>
                            <option value="2">Failed</option>
                            <option value="0">Processing</option>

                        </select>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div wire:ignore>
                        <select wire:model="order_id" class="form-control" id="order_id">
                            <option value="">Select Order Id</option>
                            @foreach($orders as $order)
                            <option value="{{$order->order_id}}">{{$order->order_id}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div wire:ignore>
                        <select wire:model="transaction_no" class="form-control" id="transaction_no">
                            <option value="">Select Transaction No</option>
                            @foreach($transactions as $trasaction)
                            <option value="{{$trasaction->transaction_no}}">{{$trasaction->transaction_no}}</option>
                            @endforeach

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

            </div>

            <div class="row md">


                <div class="col-md-3">
                    <button wire:click="resetOnClick" class="btn btn-primary" id="reset">Reset</button>
                </div>

            </div>
            <div style="overflow-x:auto;">
                <table class="table table-striped" style="width: 140%;">
                    {{-- <div style='text-align: end' ;><a href="{{route('districts.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i><span>Add District</span></a>
            </div> --}}

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Order</th>
                    <th scope="col">Date</th>
                    <th scope="col">Scheme</th>
                    <th scope="col">Total Scheme Amount</th>
                    <th scope="col">Service Charge</th>
                    <th scope="col">GST Charge</th>
                    <th scope="col">Final Amount</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Payment Type</th>

                    <th scope="col" class="fixed-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($transactionDetails) > 0)
                @foreach($transactionDetails as $transactionDetail)
                @if($transactionDetail->payment_method!='cash')
                <tr>
                    <th scope="row">{{ $transactionDetails->firstitem() + $loop->index }}</th>
                    <td>{{ $transactionDetail->deposit?->subscription?->user->name }}</td>
                    <td>{{ $transactionDetail->deposit?->order_id }}</td>
                    <td>{{ date('d-m-Y', strtotime($transactionDetail->deposit?->paid_at)) }}</td>
                    <td>{{ $transactionDetail->deposit?->subscription?->scheme?->title }}</td>

                    <td>
                        {{ \App\Models\Setting::CURRENCY }} {{ number_format($transactionDetail->deposit?->total_scheme_amount, 2) }}
                    </td>
                    <td>{{ \App\Models\Setting::CURRENCY }} {{ number_format($transactionDetail->deposit?->service_charge, 2) }}</td>
                    <td>{{ \App\Models\Setting::CURRENCY }} {{ number_format($transactionDetail->deposit?->gst_charge, 2) }}</td>
                    <td>
                        {{ \App\Models\Setting::CURRENCY }} {{ number_format($transactionDetail->deposit?->final_amount, 2) }}
                    </td>
                    <td>{{ $transactionDetail->deposit?->user_type == 'admin' ? 'Admin' : 'Customer' }}</td>
                    <td>{{ $transactionDetail->deposit?->payment_type }}</td>






                    <td class="fixed-left">
                        <a data-bs-toggle="modal" class="model" data-bs-target="#ExtralargeModal" style="color:blue" order_id="{{encrypt($transactionDetail->deposit_id)}}">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- <a href="{{route('users.edit-scheme-details',[encrypt($userSubscription->id),encrypt($userSubscription->user->id),encrypt($userSubscription->scheme->id)])}}" style="margin-right: 10px;"><i class="bi bi-pencil-square"></i></a> --}}
                        {{-- <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $district->id }}').submit();"><i class="bi bi-x-circle"></i></a> --}}
                    </td>

                    {{-- <form method="post" action="{{route('districts.destroy', encrypt($district->id))}}" style="display:none" id="delete-form-{{$district->id}}">
                    @csrf
                    @method('DELETE')
                    </form> --}}

                </tr>
                @endif
                @endforeach
                @else
                <tr>
                    <td colspan="12">No records available in table</td>
                </tr>
                @endif
                <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                    <div class="modal-dialog modal-xl fetch-transaction-list">
                    </div>
                </div>
            </tbody>
            </table>
            {{ $transactionDetails->links() }}
        </div>
        <!-- End Table with stripped rows -->

    </div>
    </div>







    </div>
    </div>
</section>

@push('scripts')

<script>
    $('#order_id').on('change', function(e) {
        var order_id = $('#order_id').val();
        @this.set('order_id', order_id);
    });
    $('#user_id').on('change', function(e) {
        var user_id = $('#user_id').val();
        @this.set('user_id', user_id);
    });
    $('#scheme_id').on('change', function(e) {
        var scheme_id = $('#scheme_id').val();
        @this.set('scheme_id', scheme_id);
    });
    $('#transaction_no').on('change', function(e) {
        var transaction_no = $('#transaction_no').val();
        @this.set('transaction_no', transaction_no);
    });
</script>
<script>
    $(document).on('click', '.model', function() {

        var id = $(this).attr('order_id');
        var status = $(this).attr('status');

        $.ajax({
            url: "{{route('users.fetch-transaction-details')}}",
            type: "GET",
            data: {
                order_id: id,
            },
            success: function(response) {

                $('.fetch-transaction-list').html(response.data);
                //fetch_transaction_details();

            }
        });


    });
</script>
@endpush
