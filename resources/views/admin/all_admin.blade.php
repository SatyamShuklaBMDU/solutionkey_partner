@extends('include.master')
@section('style-area')
    <style>
        .payment-history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-history-table th,
        .payment-history-table td {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        .payment-history-table th {
            background-color: #f2f2f2;
        }

        .payment-history-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .custom-input {
            background-color: #f8f9fa;
            border: 2px solid #ced4da;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        .dropdown-container {
            display: none;
            background-color: #262626;
            padding-left: 8px;
        }
    </style>
@endsection
@section('content')
    <main class="s-layout__content px-3">
        <div class="py-3">
            <h4>Manage Admin</h4>
        </div>
        <div class="float-end">
            @if (session()->has('message'))
                <div class="text-center alert alert-success" id="sessionMessage">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>

        <div class="data_table">
            <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <td>S.No</td>
                        {{-- <th>Created Date</th>
            <th>Update Date</th> --}}
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr data-user-id="{{ $admin->id }}">
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $admin->created_at->format('Y-m-d') }}</td>
            <td>{{ $admin->updated_at->format('Y-m-d') }}</td> --}}
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            @php
                                $userpermission = json_decode($admin->permission);
                                $allpermission = '';
                                if (!is_null($userpermission) && is_array($userpermission)) {
                                    $allpermission = implode(',', $userpermission);
                                }
                            @endphp
                            <td>{{ $allpermission }}</td>

                            {{-- <td>{{ $admin->permission}}</td> --}}
                            <td>
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" {{ $admin->status == '1' ? 'checked' : '' }}>
                                    <small style="margin-top: 5px;"></small>
                                </label>
                            </td>
                            <td>
                                <a href="{{ url('/edit-admin/' . encrypt($admin->id)) }}"><i
                                        class="fa-solid fa-pen-to-square"> </i></a>
                                <i class="fa-solid fa-trash text-danger deleteit"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
@section('script-area')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                scrollX: true,
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                var userId = $(this).closest('tr').data('user-id');
                // alert(userId);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var status = this.checked ? '1' : '0';
                // alert(status);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/updateAdminStatus') }}",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
                    },
                    data: {
                        user_id: userId,
                        status: status
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User status updated successfully!',
                            showConfirmButton: false,
                            timer: 1500 // Hide after 1.5 seconds
                        });
                        console.log('Status updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Click event listener for the trash button
            $('.deleteit').click(function() {
                var userId = $(this).closest('tr').data('user-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this user!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('/deleteAdmin') }}",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                user_id: userId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted.',
                                    'success'
                                );
                                // Remove the row from the table
                                location.reload()
                            },
                            error: function(xhr, status, error) {
                                console.error('Error deleting user:', error);
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('sessionMessage').style.display = 'none';
        }, 5000);
    </script>
@endsection
