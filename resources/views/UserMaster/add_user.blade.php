@extends('include.master')
@section('content')
<style>
    input#bt {
    background: #fc790b;
}
</style>
    <main class="s-layout__content px-3">
        <div class="py-3">
            <div>
                <h4>User Master</h4>
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
            <div class="container1">
                <form action="{{ isset($user)?route('update-user-master',encrypt($user->id)):route('add.user.master.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="txtName">Name:</label>
                            <input type="text" name="name" id="txtName" @isset($user) value="{{$user->name}}" @endisset placeholder="Name" class="w-100 p-1" />
                        </div>
                        <div class="col-lg-6">
                            <label for="txtAge">Email:</label>
                            <input type="text" name="email" id="txtAge" @isset($user) value="{{$user->email}}" @endisset placeholder="Email" class="w-100 p-1" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="number">Mobile Number:</label>
                            <input type="number" name="phone_number" @isset($user) value="{{$user->phone_number}}" @endisset id="number" placeholder="Phone Number"
                                class="w-100 p-1" />
                        </div>
                        <div class="col-lg-6">
                            <label for="file">Profile:</label>
                            <input type="file" id="file" name="photo" class="w-100 p-1 form-control" />
                            @isset($user)
                                <div class="mt-1">
                                    <img src="{{asset($user->photo)}}" alt="Not Available" style="height:100px;width:100px;">
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-orange" id="bt" value="{{ isset($user)?'Update':'Submit' }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
