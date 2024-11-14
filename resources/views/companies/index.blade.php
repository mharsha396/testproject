@extends('layouts.app')

@section('content')
    <x-heading>Company List</x-heading>
    @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
    @endif
    <div class="text-end mb-5">
           <!-- "Create Company" Button -->
           <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Create New Company</a>
    </div>
    
    <table id="companies-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be loaded here using DataTables -->
        </tbody>
    </table>

@endsection

    <!-- DataTables CSS and JS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#companies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('companies.index') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'logo', name: 'logo' },
                    { data: 'website', name: 'website' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                pageLength: 10
            });
        });
    </script>

