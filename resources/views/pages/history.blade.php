@extends('layouts.dashboard')

@section('content')
<div class="table-responsive">
    <table class="table table-striped table-sm" id="example">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">PIC</th>
            <th scope="col">Email</th>
            <th scope="col">Website</th>
            <th scope="col">Company Address</th>
            <th scope="col">Email Schedule</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
</div>
@endsection

@push('addon-script')

@endpush