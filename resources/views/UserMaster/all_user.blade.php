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
    <main class="s-layout__content mt-5">
        <div class="d-flex row">
            <div class="py-3 col-md-6">
                <h4>User Master</h4>
            </div>
            <div class="py-3 col-md-6">
                <a href="{{ route('add.user.master.index') }}" class="btn btn-primary float-end">Add User Master</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success" style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        <div class="data_table">
            <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <td>S.No</td>
                        <td>Created Time</td>
                        <td>Updated Time</td>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $user->updated_at->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <img src="{{ asset($user->photo) }}" alt="Not" style="height: 50px;width:50px;">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked{{ $loop->iteration }}"
                                        {{ $user->status == 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked{{ $loop->iteration }}"
                                        id="labelText"></label>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('edit.user.master',encrypt($user->id))}}"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                                <i class="fa-solid fa-trash text-danger px-2 deleteit"></i>
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
                var status = this.checked ? 'active' : 'inactive';
                // alert(status);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/updateUserMasterStatus') }}",
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
                            url: "{{ url('/deleteUserMaster') }}",
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
        const checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const labelText = this.nextElementSibling; // Get the label element next to the checkbox
                if (this.checked) {
                    labelText.innerText = 'Active';
                    labelText.classList.add('active');
                    labelText.classList.remove('inactive');
                } else {
                    labelText.innerText = 'Deactivate';
                    labelText.classList.add('inactive');
                    labelText.classList.remove('active');
                }
            });

            // Update initial state on page load
            const labelText = checkbox.nextElementSibling;
            if (checkbox.checked) {
                labelText.innerText = 'Active';
                labelText.classList.add('active');
                labelText.classList.remove('inactive');
            } else {
                labelText.innerText = 'Deactivate';
                labelText.classList.add('inactive');
                labelText.classList.remove('active');
            }
        });
    </script>
@endsection
