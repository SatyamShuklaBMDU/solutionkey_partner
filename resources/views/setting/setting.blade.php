@extends('include.master')
@section('style-area')
    <style>
        .profile-pic {
            width: 200px;
            max-height: 200px;
            display: inline-block;
        }

        .file-upload {
            display: none;
        }

        .circle {
            border-radius: 100% !important;
            overflow: hidden;
            width: 128px;
            height: 128px;
            border: 2px solid gray;
            position: relative;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .p-image {
            position: absolute;
            bottom: 5%;
            right: 70px;
            color: green;
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .upload-button {
            font-size: 1.2em;
        }

        .upload-button:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
            color: #999;
        }
    </style>
    <style>
        /* Custom styles for Select2 with checkboxes */
        .select2-container {
            width: calc(100% - 50px) !important;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border: 1px solid #0056b3;
            color: white;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ff0000;
            cursor: pointer;
            margin-right: 5px;
        }

        .select2-dropdown {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        .select2-results__option {
            padding: 8px 12px;
            cursor: pointer;
        }

        .select2-results__option--highlighted {
            background-color: #007bff;
            color: white;
        }

        .select2-results__option input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <div>
                <h4 class="fw-bold">Edit Profile</h4>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container2">
                <form action="{{ route('profile.basic.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5 class="pb-4 text-success">Basic Information</h5>
                        <div class="col-md-2">
                            <div class="small-12 medium-2 large-2 columns" style="position: relative">
                                <div class="circle">
                                    <img class="profile-pic"
                                        @if (isset($user->profile_pic)) src="{{ asset($user->profile_pic) }}" @else src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" @endif>
                                </div>
                                <div class="p-image">
                                    {{-- <i class="fa fa-camera upload-button"></i> --}}
                                    <input class="file-upload" type="file" name="image" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="txtName">Name:</label>
                                    <input type="text" name="name" id="txtName"
                                        @isset($user) value="{{ $user->name }}" readonly @endisset
                                        placeholder="Name" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="txtAge">Email:</label>
                                    <input type="text" name="email" id="txtAge"
                                        @isset($user) value="{{ $user->email }}" readonly @endisset
                                        placeholder="Email" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="Gender">Gender</label>
                                    <input type="text" id="Gender"
                                        @isset($user->gender) value="{{ $user->gender }}" readonly @endisset
                                        name="gender" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="appointment">Appointment Per Charges Rs.</label>
                                    <input type="text" id="appointment" placeholder="₹"
                                        @isset($user->appointment_charge) value="{{ $user->appointment_charge }}" readonly @endisset
                                        name="appointment" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container2 mt-4">
                <form action="{{ route('setting.bank-info.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5 class="pb-4 text-success">Bank Info</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="account_number">Account Number:</label>
                                    <input type="number" name="account_number" id="account_number"
                                        @isset($account) value="{{ $account->aacount_number }}" @endisset
                                        placeholder="Account Number" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="ifsc">IFSC:</label>
                                    <input type="text" name="ifsc" id="ifsc"
                                        @isset($account) value="{{ $account->ifsc }}" @endisset
                                        placeholder="IFSC" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="bankname">Bank Name</label>
                                    <input type="text" id="bankname"
                                        @isset($account) value="{{ $account->bank_name }}" @endisset
                                        name="bankname" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="customername">Customer Name</label>
                                    <input type="text" id="customername" placeholder="₹"
                                        @isset($account) value="{{ $account->customer_name }}" @endisset
                                        name="customername" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="branchname">Branch Name</label>
                                    <input type="text" id="branchname"
                                        @isset($account) value="{{ $account->branch_name }}" @endisset
                                        name="branchname" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="upi_id">UPI Id</label>
                                    <input type="text" id="upi_id" placeholder="₹"
                                        @isset($account) value="{{ $account->upi_id }}" @endisset
                                        name="upi_id" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="upi_number">UPI Number</label>
                                    <input type="text" id="upi_number"
                                        @isset($account) value="{{ $account->upi_number }}" @endisset
                                        name="upi_number" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-warning w-100 p-1 mt-4"
                                        value="{{ isset($account) ? 'Update' : 'Submit' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container2 mt-4">
                <form action="{{ route('setting.time_slots.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5 class="pb-4 text-success">Available Time Slot For Appointment</h5>
                        <div class="col-md-12 mb-5">
                            <label for="time-slots">Select Time Slot (Online)</label>
                            <select id="time-slots" name="time_slots_online[]" style="margin-top: 10%;"
                                multiple="multiple" required>
                                @foreach ($timeSlots as $slot)
                                    <option value="{{ $slot }}">{{ $slot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="time-slots2">Select Time Slot (Offline)</label>
                            <select id="time-slots2" name="time_slots_offline[]" style="margin-top: 10%;"
                                multiple="multiple" required>
                                @foreach ($timeSlots as $slot)
                                    <option value="{{ $slot }}">{{ $slot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-warning w-100 p-1 mt-4"
                                    value="{{ isset($user) ? 'Update' : 'Submit' }}" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('script-area')
    <script>
        function initializeSelect2(selector) {
            $(selector).select2({
                placeholder: 'Select time slots',
                allowClear: true,
                templateResult: formatState,
                closeOnSelect: false
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><input type="checkbox" /> ' + state.text + '</span>'
                );
                return $state;
            }

            $(selector).on('select2:select', function(e) {
                var $element = $(e.params.data.element);
                var $state = $(e.params.data._result);
                $state.find('input[type="checkbox"]').prop('checked', true);
                $element.prop('selected', true);
            });

            $(selector).on('select2:unselect', function(e) {
                var $element = $(e.params.data.element);
                var $state = $(e.params.data._result);
                $state.find('input[type="checkbox"]').prop('checked', false);
                $element.prop('selected', false);
            });

            $(selector).on('select2:open', function() {
                setTimeout(function() {
                    $('.select2-results__option').each(function() {
                        var $state = $(this);
                        var $input = $state.find('input[type="checkbox"]');
                        if ($input.length === 0) {
                            var text = $state.text();
                            $state.html('<input type="checkbox" /> ' + text);
                        }
                    });

                    // Ensure the checkboxes reflect the current selection state
                    $(selector).find('option').each(function() {
                        var $option = $(this);
                        var $state = $('.select2-results__option:contains("' + $option
                            .text() + '")');
                        $state.find('input[type="checkbox"]').prop('checked', $option.is(
                            ':selected'));
                    });
                }, 0);
            });
        }

        $(document).ready(function() {
            initializeSelect2('#time-slots');
            initializeSelect2('#time-slots2');

            @if (session()->has('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@endsection
