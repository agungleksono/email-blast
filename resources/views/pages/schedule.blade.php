@extends('layouts.dashboard')

@section('content')
<a href="{{ url('/export-email-schedules') }}" class="btn btn-success">
    Export to Excel
</a>
<form action="{{ route('import-schedule') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xls,.xlsx">
    <button type="submit" class="btn btn-info btn-sm">Import Users</button>
</form>
<form action="{{ url('/email-schedule') }}" method="post" onsubmit="return confirmDeleteAll(event)">
@csrf
<div class="mt-2 mb-4">
    <input type="date" id="birthday" name="date_schedule">
    <input type="time" id="birthday" name="time_schedule">
    <!-- <input class="btn btn-success btn-sm ms-2" type="submit" name="submit" value="Set Schedule">
    <input type="submit" name="submit" value="Delete"> -->
    <button type="submit" class="btn btn-success btn-sm ms-2" name="submit" value="schedule">Set Schedule</button>
    <button type="submit" class="btn btn-danger btn-sm ms-2" name="submit" value="delete">Delete</button>
    <button type="submit" class="btn btn-warning btn-sm ms-2" name="submit" value="delete-all" id="deleteAllBtn">Delete All</button>

</div>
<div class="table-responsive">
    <table class="table table-striped table-sm" id="example">
    <thead>
        <tr>
            <th scope="col">
                <input type="checkbox" id="select-all">
            </th>
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
        @foreach ($clients as $client)
        <tr>
            <td><input class="form-check-input row-checkbox" type="checkbox" name="checkbox[]" value="{{ $client->id }}"></td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $client->company_name }}</td>
            <td>{{ $client->pic }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->website }}</td>
            <td>{{ $client->company_address }}</td>
            <td>{{ $client->email_schedule }}</td>
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

    function confirmDeleteAll(event) {
        const form = event.target;
        const clickedButton = document.activeElement;

        if (clickedButton.name === "submit" && clickedButton.value === "delete-all") {
            const confirmDelete = confirm("Are you sure you want to delete ALL records?");
            if (!confirmDelete) {
                event.preventDefault(); // Cancel form submission
                return false;
            }
        }

        return true; // Allow form submission for other buttons
    }
</script>
@endpush