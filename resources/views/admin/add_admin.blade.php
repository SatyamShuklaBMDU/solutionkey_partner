@extends('include.master')
@section('content')
    <main class="s-layout__content px-3">
        <div class="py-3">
            <div>
                <h4>Manage admin</h4>
            </div>
            <div class="container1">
                <form action="{{ url('add-admin') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="name" id="txtName" placeholder="Name" class="w-100 p-1"/>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="email" id="txtAge" placeholder="Email" class="w-100 p-1"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="password" name="password" id="txtEmail" placeholder="Create Password"
                                class="w-100 p-1" />
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="role" id="txtPhone" placeholder="Role" class="w-100 p-1" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="number" name="mobile_no" id="number" placeholder="Phone Number"
                                class="w-100 p-1" />
                        </div>
                    </div>
                    <div class="py-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="client_profile">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Client Profile</p>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="role_manager">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Role Manager</p>
                                </label>
                            </div>
                            {{-- <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="history">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">History</p>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="feedback">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Feedback</p>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="complaint">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Complaint</p>
                                </label>
                            </div> --}}
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="payment_history">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Payment History</p>
                                </label>
                            </div>
                            {{-- <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="bill">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Bill</p>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="task">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Task</p>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="switch m5 d-flex">
                                    <input type="checkbox" name="permission[]" value="call_log">
                                    <small style="margin-top: 5px;"></small>
                                    <p class="px-2">Call Log</p>
                                </label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-primary" id="bt" value="Save Scene" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
