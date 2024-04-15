<div class="d-flex justify-content-center">
    <div class="s-layout">
      <div class="s-layout__sidebar" style="z-index: 1;">
        <a class="s-sidebar__trigger" href="#0">
          <i class="fa fa-bars" style="color: white;"></i>
        </a>
        <nav class="s-sidebar__nav">
          <ul>
            <li>
              <a class="s-sidebar__nav-link active" href="{{route('dashboard')}}">
                <i class="fa fa-home"></i><em>Dashbord</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="{{route('user.index')}}">
                <i class="fa-solid fa-user"></i><em>Client Profile</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="#0">
                <i class="fa-brands fa-critical-role"></i><em>Role Management</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="#0">
                <i class="fa-solid fa-clock-rotate-left"></i><em>History</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="/complaint.html">
                <i class="fa-solid fa-circle-dot"></i><em>Complain</em>
              </a>
            </li>
            <li class=" dropdown-btn position-relative">
              <a class="s-sidebar__nav-link d-flex justify-content-between">
                <i class="fa-solid fa-user-plus"></i><em>Manage Admin</em>
                <div>
                  <i class="fa-solid fa-caret-down position-absolute" style="right: 19px; top: 11px;"></i>
                </div>
              </a>
            </li>
            <div class="dropdown-container">
              <li>
                <a class="s-sidebar__nav-link" href="{{route('admin.all.index')}}">
                  <em>All User</em>
                </a>
              </li>
              <li>
                <a class="s-sidebar__nav-link" href="{{route('admin.index')}}">
                  <em>Add User</em>
                </a>
              </li>
            </div>
            <li>
              <a class="s-sidebar__nav-link" href="#0">
                <i class="fa-brands fa-stack-overflow"></i><em>Task</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="/call-log.html">
                <i class="fa-solid fa-phone-volume"></i><em>Call log</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="/feedback.html">
                <i class="fa-solid fa-message"></i><em>Feedback</em>
              </a>
            <li>
              <a class="s-sidebar__nav-link" href="/payment.html">
                <i class="fa-solid fa-indian-rupee-sign"></i><em>Payment history</em>
              </a>
            </li>
            <li>
              <a class="s-sidebar__nav-link" href="/Billing-Management.html">
                <i class="fa-solid fa-money-bill"></i><em>Billing Management</em>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>