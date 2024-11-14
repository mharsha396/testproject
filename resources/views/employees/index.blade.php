@extends('layouts.app')

@section('content')
<div class="container">
    <x-heading>
        Employee List
    </x-heading>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
   @endif
   <div class="text-end mb-5">
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create Employee</a>
   </div>
    
    <table class="table table-bordered" id="employees-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('employees.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'company', name: 'company' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                pageLength: 10
            });
        });
    </script>
