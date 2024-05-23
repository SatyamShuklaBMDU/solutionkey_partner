<nav class="navbar navbar-expand-lg navbar-dark bg-light shadow-sm" style="z-index: 1;">
    <div class="container-fluid">
        <div class="">
            <img src="{{ asset('images/logo-3.webp') }}" alt="" style="width: 120px;">
        </div>
        <div class="d-flex justify-content-center">
            <div class="pt-3" id="openModalButton">
                <p class=" px-4"><i class="fa-solid fa-bell"></i></p>
            </div>
            <div class="d-flex justify-content-center" style=" margin-top: 14px;">
                <div style="height: 30px; width: 30px;">
                    <img src="images/profile.png" alt="" style="width: 20px;">
                </div>
                <div class="d-flex">
                    <div onclick="myFunction()" class="d-flex ">
                        <p class="fs-6 dropbtn">Hi, {{ auth()->guard('admins')->user()->name }}</p>
                        <i class="fa-solid fa-caret-down px-2 mt-1 dropbtn"></i>
                    </div>
                    <div id="myDropdown" class="dropdown-content">
                        <div class="d-flex justify-content-start px-2 py-1">
                            <i class="fa-solid fa-signal mt-1"></i>
                            <form id="statusForm" action="{{ route('user.changeStatus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" id="statusInput" value="{{ auth()->guard('admins')->user()->status == 1 ? '0' : '1' }}">
                                <button type="submit" id="statusButton" class="btn btn-link"
                                    style="text-decoration: none;">Set Online</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-start px-2 py-1">
                            <i class="fa-solid fa-user-pen mt-1"></i>
                            <a href="{{ route('profile.edit') }}">Edit Profiles</a>
                        </div>
                        <div class="d-flex justify-content-start px-2 py-1">
                            <i class="fa-solid fa-gear mt-1"></i>
                            <a href="{{ route('setting.index') }}">Settings</a>
                        </div>
                        <div class="d-flex justify-content-start px-2 py-1">
                            <i class="fa-solid fa-arrow-right-from-bracket mt-1"></i>
                            <a href="{{ url('logout-user') }}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
