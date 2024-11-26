@push('scripts')
@if(Session::get('success', false))
<?php $data = session()->get('success'); ?>
@if (is_array($data))
@foreach ($data as $msg)
<script>
    toastr.success("{{ $msg }}");
</script>
@endforeach
@else
<script>
    toastr.success("{{ $data }}");
</script>
@endif
@endif
@endpush