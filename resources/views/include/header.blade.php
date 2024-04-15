<nav class="navbar navbar-expand-lg navbar-dark bg-light shadow-sm" style="z-index: 1;">
    <div class="container-fluid">
      <div class="">
        <img src="{{asset('images/logo-3.webp')}}" alt="" style="width: 120px;">
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
            <p class="fs-6">Profile</p>
            <i onclick="myFunction()" class="fa-solid fa-caret-down px-2 mt-1 dropbtn"></i>
            <div id="myDropdown" class="dropdown-content">
              <div class="d-flex justify-content-start px-2 py-1">
                <i class="fa-solid fa-arrow-right-from-bracket mt-1"></i>
                <a href="{{url('logout-user')}}">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>