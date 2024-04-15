@extends('include.master')
@section('style-area')
    <style>
        .icon-bg {
            width: 50px;
            height: 50px;
            background-color: #3256cb2e;
            /* Customize the icon background color */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon {
            width: 30px;
            height: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            /* Add rounded corners to the card */
            transition: box-shadow 0.3s;
            /* Add a smooth shadow transition on hover */
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow on hover */
        }

        .custom-date-input {
            font-size: 0.8rem;
            /* Adjust the font size as needed */
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            box-sizing: border-box;
        }

        .custom-date-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        div.dt-container {
            width: 98%;
            margin: 0 auto;
        }

        .dropdown-container {
            display: none;
            background-color: #262626;
            padding-left: 8px;
        }

        /* Style for the switch checkbox */
        .form-check-input:checked {
            background-color: green !important;
        }

        .form-check-input:not(:checked) {
            background-color: red !important;
        }
    </style>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <main class="s-layout__content px-3">
        <div>
            <h4 class="py-2">Client Profile</h4>
        </div>
        <div class="py-3">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{ route('filter-user') }}" method="post">
                            <div class="row justify-content-start">
                                @csrf
                                <div class="col-md-4">
                                    <label for="datepicker1">From Date:</label>
                                    <input id="datepicker1" width="250" value="{{$start??''}}" name="start" />
                                    @if ($errors->has('start'))
                                        <div class="text-danger">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="datepicker2">To Date:</label>
                                    <input id="datepicker2" width="250" value="{{$end??''}}" name="end" />
                                    @if ($errors->has('end'))
                                        <div class="text-danger">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 mt-4 d-flex">
                                    <div>
                                        <label for=""></label>
                                        <button class="btn btn-success"
                                            style="border: 0px 9px; font-size:12px;">Filter</button>
                                    </div>
                                    <div>
                                        <label for=""></label>
                                        <a class="btn btn-success" href="{{url('users')}}" style="border: 0px 9px; font-size:12px; margin-left: 10px;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end mt-4">
                            {{-- <div class="row d-flex justify-content-end px-4">
                                <div>
                                    <button id="openModalBtn" class="btn btn-success" style="font-size: 10px;">Add
                                        Client</button>
                                </div>
                                <div id="myModal" class="modal">
                                    <div class="modal-content">
                                        <div class="">
                                            <h5>Add Client</h5>
                                            <span class="close" style="text-align: end;">&times;</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mt-3">
                                                <input type="text" id="txtName" placeholder="Name"
                                                    class="w-100 p-1 input-field" />
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <input type="number" id="txtAge" placeholder="Number"
                                                    class="w-100 p-1 input-field" />
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <input type="number" id="txtEmail" placeholder="Whatsapp Number"
                                                    class="w-100 p-1 input-field" />
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <input type="text" id="txtPhone" placeholder="Email"
                                                    class="w-100 p-1 input-field" />
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <input type="text" id="txtPincode" placeholder="pincode"
                                                    class="w-100 p-1 input-field" />
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <select name="state" id="state" class="w-100 py-1">
                                                    <option value="volvo">--sate--</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <select name="city" id="city" class="w-100 py-1">
                                                    <option value="volvo">--city--</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 mt-3">
                                                <!-- <input type="number" id="txtEmail" placeholder="address" class="w-100 p-1 input-field" /> -->
                                                <textarea name="" id="" cols="3" class="w-100"></textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn close"
                                                style="font-size: 15px; background-color: red; color:white; font-weight: 400;">close</button>
                                            <button class="btn btn-primary ml-2" style="margin-left: 2px;">save</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="">
                                <button id="uploadBtn" class="btn btn-success"
                                    style="font-size: 15px; font-weight: 400; font-size: 10px;">Upload</button>
                            </div>
                        </div>
                    </div>

                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <form action="/action_page.php">
                                <div class="py-8">
                                    <label for="default"
                                        class="block text-sm leading-5 font-medium text-gray-700 mb-4">Choose Excel
                                        File</label>
                                    <input type="file" name="default" id="default" class="border p-2">
                                </div>
                            </form>
                            <div class="d-flex justify-content-end mt-4">
                                <button id="closePopupBtn" style="font-size: 10px;" class="btn btn-success">Close</button>
                                <button class="btn btn-success" style="font-size: 10px; margin-left: 9px;">sumbit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" py-3 col-lg-12 data_table">
                <table id="example" class="table table-bordered table-striped" style="overflow-x: scroll;">
                    <thead>
                        <tr>
                            <td>S.No</td>
                            <th>Name</th>
                            <th>CIN NO.</th>
                            <th>Registration Date</th>
                            <th>Updation Date</th>
                            <th>Phone No.</th>
                            <th>Whatsapp No.</th>
                            <th>Email</th>
                            <th style="width: 900px;">Address</th>
                            <th>PIN Code</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr data-user-id="{{ $user->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->cin_no }}</td>
                                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->whatsapp_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->pincode }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->state }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked{{ $loop->iteration }}"
                                            {{ $user->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked{{ $loop->iteration }}"
                                            id="labelText">Deactivate</label>
                                    </div>
                                </td>
                                <td>
                                    {{-- <i class="fa-solid fa-pen-to-square text-success" id="ModalBtn"></i> --}}
                                    <i class="fa-solid fa-trash text-danger px-2 deleteit"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#txtPincode').on('input', function() {
                var pincode = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/getCityState') }}",
                    data: {
                        pincode: pincode
                    },
                    success: function(response) {
                        $('#city').html('<option value="' + response.city + '">' + response
                            .city + '</option>');
                        $('#state').html('<option value="' + response.state + '">' + response
                            .state + '</option>');
                    }
                });
            });
        });
    </script>
    <script>
        new DataTable('#example', {
            // scrollX: true,
            // scrollY: 200,
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script>
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#openModalBtn").click(function() {
                $("#myModal").fadeIn();
            });

            $(".close").click(function() {
                $("#myModal").fadeOut();
            });

            $(window).click(function(event) {
                if (event.target == $("#myModal")[0]) {
                    $("#myModal").fadeOut();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#ModalBtn").click(function() {
                $(".modal").fadeIn();
            });

            $(".close").click(function() {
                $(".modal").fadeOut();
            });

            $(window).click(function(event) {
                if (event.target == $(".modal")[0]) {
                    $(".modal").fadeOut();
                }
            });
        });
    </script>
    <script>
        var uploadBtn = document.getElementById("uploadBtn");
        var popup = document.getElementById("popup");
        var closePopupBtn = document.getElementById("closePopupBtn");
        uploadBtn.onclick = function() {
            popup.style.display = "block";
        }
        closePopupBtn.onclick = function() {
            popup.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        }
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
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                var userId = $(this).closest('tr').data('user-id');
                // alert(userId);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var status = this.checked ? 'active' : 'inactive';
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/updateUserStatus') }}",
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
                            url: "{{ url('/deleteUser') }}",
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
                                $(this).closest('tr').remove();
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
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'd/mm/yyyy',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function() {
                return $('#datepicker2').val();
            }
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'd/mm/yyyy',
            iconsLibrary: 'fontawesome',
            minDate: function() {
                return $('#datepicker1').val();
            }
        });
    </script>
@endsection
