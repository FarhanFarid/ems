@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-4">
        @include('apps.subviews.detsform')
    </div>
    <div class="col-md-8">
        @include('apps.subviews.detssummary')
    </div>
</div>

@endsection

@push('script')
<script>
    var config = {
            routes: {
                apps :{
                    save: "{{ route('apps.savearrangement') }}",
                    getarrangementlist: "{{ route('apps.getarrangementlist') }}",
                },
            }
        };
</script>
<script src="{{ asset('js/apps/details.js') }}"></script>
@endpush
