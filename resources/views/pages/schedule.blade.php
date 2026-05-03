@extends('layouts.dashboard')

@section('content')
<!-- <a href="{{ url('/export-email-schedules') }}" class="btn btn-success">
    Export to Excel
</a> -->
<form action="{{ route('import-schedule') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xls,.xlsx">
    <button type="submit" class="btn btn-info btn-sm">Import Users</button>
</form>
<form action="{{ url('/email-schedule') }}" method="post" onsubmit="return confirmDeleteAll(event)">
@csrf
<div class="mt-2 mb-4">
    <input type="date" name="date_schedule">
    <input type="time" name="time_schedule">
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
            <th scope="col" class="ps-3">Company Name</th>
            <th scope="col" class="ps-3">PIC</th>
            <th scope="col" class="ps-3">Section</th>
            <th scope="col" class="ps-3">Email</th>
            <th scope="col" class="ps-3">Website</th>
            <th scope="col" class="ps-3">Company Address</th>
            <th scope="col" class="ps-3">Email Schedule</th>
            <th scope="col" class="ps-3">Product</th>
            <th scope="col" class="ps-3">Subject Email</th>
            <th scope="col" class="ps-3">Introduction</th>
            <th scope="col" class="ps-3">Form 1</th>
            <th scope="col" class="ps-3">Form 3</th>
            <th scope="col" class="ps-3">Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td><input class="form-check-input row-checkbox" type="checkbox" name="checkbox[]" value="{{ $client->id }}"></td>
            <td class="ps-3">{{ $loop->iteration }}</td>
            <td class="ps-3">{{ $client->company_name }}</td>
            <td class="ps-3">{{ $client->pic }}</td>
            <td class="ps-3">{{ $client->section }}</td>
            <td class="ps-3">{{ $client->email }}</td>
            <td class="ps-3">{{ $client->website }}</td>
            <td class="ps-3">{{ $client->company_address }}</td>
            <td class="ps-3">{{ $client->email_schedule }}</td>
            <td class="text-nowrap ps-3">{{ $client->product }}</td>
            <td class="text-nowrap ps-3">{{ $client->subject }}</td>
            <td class="text-nowrap ps-3">{{ $client->email_intro }}</td>
            <td class="text-nowrap ps-3">{{ $client->form_1 }}</td>
            <td class="text-nowrap ps-3">{{ $client->form_3 }}</td>
            <td class="ps-3">{{ $client->email_type }}</td>
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