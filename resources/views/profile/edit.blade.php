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
                                        @if (isset($user->profile_picture)) src="{{ asset($user->profile_picture) }}" @else src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" @endif>
                                </div>
                                <div class="p-image">
                                    <i class="fa fa-camera upload-button"></i>
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
                                    <label for="number">Mobile Number:</label>
                                    <input type="number" name="phone_number"
                                        @isset($user->phone_number) value="{{ $user->phone_number }}" readonly @endisset
                                        id="number" placeholder="Phone Number" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="appointment">Appointment Per Charges Rs.</label>
                                    <input type="text" id="appointment" placeholder="₹"
                                        @isset($user->appointment_charge) value="{{ $user->appointment_charge }}" readonly @endisset
                                        name="appointment" class="w-100 p-1 form-control" />
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
                                    <input type="submit" class="btn btn-warning w-100 p-1 mt-4"
                                        value="{{ isset($user) ? 'Update' : 'Submit' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container2 mt-4">
                <form action="{{ route('profile.contact.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5 class="pb-4 text-success">Contact Information</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" id="address"
                                        @isset($user->address) value="{{ $user->address }}" @endisset
                                        placeholder="Address" class="w-100 p-1 form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="state">State:</label>
                                    <input type="state" name="state"
                                        @isset($user->state) value="{{ $user->state }}" @endisset
                                        id="state" placeholder="State" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="country">Country.</label>
                                    <input type="text" id="country"
                                        @isset($user->country) value="{{ $user->country }}" @endisset
                                        name="country" class="w-100 p-1 form-control" placeholder="Country" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="pincode">Pincode:</label>
                                    <input type="pincode" name="pincode"
                                        @isset($user->pincode) value="{{ $user->pincode }}" @endisset
                                        id="pincode" placeholder="Pincode" class="w-100 p-1 form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="Specialization">Specialization</label>
                                    <input type="text" id="Specialization"
                                        @isset($user->specialization) value="{{ $user->specialization }}" readonly @endisset
                                        name="specialization" class="w-100 p-1 form-control"
                                        placeholder="Specialization" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-warning w-100 p-1 mt-4"
                                        value="{{ isset($user) ? 'Update' : 'Submit' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container2 mt-4">
                <form action="{{ route('profile.password.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5 class="pb-4 text-success">Change Password</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="Old_Password">Old Password:</label>
                                    <input type="Old_Password" name="old_password" id="Old_Password"
                                        placeholder="Old Password" class="w-100 p-1 form-control" />
                                    @error('old_password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label for="New_Password">New Password.</label>
                                    <input type="text" id="New_Password" name="new_password"
                                        class="w-100 p-1 form-control" placeholder="New Password" />
                                    @error('new_password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label for="Confirm_Password">Confirm Password.</label>
                                    <input type="text" id="Confirm_Password" name="new_password_confirmation"
                                        class="w-100 p-1 form-control" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-warning w-100 p-1 mt-4"
                                        value="{{ isset($user) ? 'Update' : 'Submit' }}" />
                                </div>
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
        $(document).ready(function() {
            @if (session()->has('success'))
                toastr.success('{{ session('success') }}');
            @endif
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function() {
                readURL(this);
            });
            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
@endsection
