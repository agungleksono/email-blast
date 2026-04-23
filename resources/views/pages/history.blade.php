@extends('layouts.dashboard')

@section('content')
<form action="{{ route('index.history') }}" method="get">
    @csrf
    <label for="">Start Date</label>
    <input type="date" id="searchStartDate" name="start_date" class="me-2" required>
    <label for="">End Date</label>
    <input type="date" id="searchEndDate" name="end_date" required>
    <button type="submit" name="submit" value="search" class="btn btn-info btn-sm">Search</button>
</form>
<form action="{{ url('/email-schedule') }}" method="post">
@csrf
<div class="mt-2 mb-4">
    <input type="date" id="date_schedule" name="date_schedule" required>
    <input type="time" id="time_schedule" name="time_schedule" required>
    <!-- <input class="btn btn-success btn-sm ms-2" type="submit" name="submit" value="Set Schedule">
    <input type="submit" name="submit" value="Delete"> -->
    <button type="submit" class="btn btn-success btn-sm ms-2" name="submit" value="schedule">Reschedule</button>
    <button type="submit" class="btn btn-danger btn-sm ms-2" name="submit" value="delete">Delete</button>

</div>
<div class="table-responsive">
    <table class="table table-striped table-sm" id="example">
    <thead>
        <tr>
            <th scope="col"><input type="checkbox" id="select-all" class="form-check-input"></th>
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
        @foreach ($histories as $history)
        <tr>
            <td><input class="form-check-input row-checkbox" type="checkbox" name="checkbox[]" value="{{ $history->id }}"></td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $history->company_name }}</td>
            <td>{{ $history->pic }}</td>
            <td>{{ $history->email }}</td>
            <td>{{ $history->website }}</td>
            <td>{{ $history->company_address }}</td>
            <td>{{ $history->email_schedule }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</form>
@endsection

@push('addon-script')
<script>
    document.getElementById('select-all').addEventListener('change', function () {

        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('select-all').addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent checkbox click from triggering sort
    });

</script>
@endpush