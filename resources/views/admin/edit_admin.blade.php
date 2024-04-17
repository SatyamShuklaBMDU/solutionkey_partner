@extends('include.master')
@section('content')
    <main class="s-layout__content px-3">
        <div class="py-3">
            <div>
                <h4>Manage admin</h4>
            </div>
            <div class="container1">
                <form action="{{ url('/update-admin/' .  encrypt($admin->id)) }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- @dd($admin); --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="name" id="txtName" placeholder="Name" class="w-100 p-1"
                                value="{{ $admin->name }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="txtAge" placeholder="Email" class="w-100 p-1"
                                value="{{ $admin->email }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <input type="text" name="role" id="txtPhone" placeholder="Role" class="w-100 p-1"
                                value="{{ $admin->role }}">
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <input type="number" name="mobile_no" id="number" placeholder="Phone Number"
                                class="w-100 p-1" value="{{ $admin->mobile_no }}">
                            @error('mobile_no')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="py-4">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="client_profile"
                                            {{ in_array('client_profile', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Client Profile</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="role_manager"
                                            {{ in_array('role_manager', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Role Manager</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="history"
                                            {{ in_array('history', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">History</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="feedback"
                                            {{ in_array('feedback', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Feedback</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="complaint"
                                            {{ in_array('complaint', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Complaint</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="payment_history"
                                            {{ in_array('payment_history', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Payment History</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="bill"
                                            {{ in_array('bill', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Bill</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="manage_admin"
                                            {{ in_array('manage_admin', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Manage Admin</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="task"
                                            {{ in_array('task', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Task</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="switch m5 d-flex">
                                        <input type="checkbox" name="permission[]" value="call_log"
                                            {{ in_array('call_log', isset($admin) ? json_decode($admin->permission) : []) ? 'checked' : '' }}>
                                        <small style="margin-top: 5px;"></small>
                                        <p class="px-2">Call Log</p>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary" id="bt" value="Update">
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </main>
@endsection
