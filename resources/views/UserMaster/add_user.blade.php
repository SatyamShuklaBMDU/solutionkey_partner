@extends('include.master')
@section('content')
    <main class="s-layout__content px-3">
        <div class="py-3">
            <div>
                <h4>User Master</h4>
            </div>
            <div class="container1">
                <form action="{{ url('add-admin') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="name" id="txtName" placeholder="Name" class="w-100 p-1" />
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="email" id="txtAge" placeholder="Email" class="w-100 p-1" />
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
