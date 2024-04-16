<div class="col-md-3">
    <div class="d-flex justify-content-center">
        <div class="sidebar-nav">
            <div class="s-layout__sidebar" style="z-index: 1;">
                <a class="s-sidebar__trigger" href="#0">
                    <i class="fa fa-bars" style="color: white;"></i>
                </a>
                <nav class="s-sidebar__nav">
                    <ul>
                        <li>
                            <a class="s-sidebar__nav-link active" href="{{ route('dashboard') }}">
                                <i class="fa fa-tachometer text-warning"></i><em class="text-white">Dashbord</em>
                            </a>
                        </li>
                        {{-- @dd(auth()->guard('admins')->check()) --}}
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('user'))
                            <li>
                                <a class="s-sidebar__nav-link" href="{{ route('add.user.master.show') }}">
                                    <i class="fa-solid fa-user text-warning"></i><em class="text-white">User Master</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('manage_admin'))
                            <li class=" dropdown-btn position-relative">
                                <a class="s-sidebar__nav-link d-flex justify-content-between">

                                    <i class="fa fa-cogs  text-warning"></i><em class="text-white">Role Management</em>
                                    <div>
                                        <i class="fa-solid fa-caret-down position-absolute"
                                            style="right: 19px; top: 11px;"></i>
                                    </div>
                                </a>
                            </li>
                            <div class="dropdown-container">
                                <li>
                                    <a class="s-sidebar__nav-link" href="{{ route('admin.all.index') }}">
                                        <em>All User</em>
                                    </a>
                                </li>
                                <li>
                                    <a class="s-sidebar__nav-link" href="{{ route('admin.index') }}">
                                        <em>Add User</em>
                                    </a>
                                </li>
                            </div>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('client_profile'))
                            <li>
                                <a class="s-sidebar__nav-link" href="{{ route('user.index') }}">
                                    <i class="fa fa-users  text-warning" aria-hidden="true"></i><em
                                        class="text-white">Client
                                        Profile Master</em>
                                </a>
                            </li>
                        @endif
                        <!-- html  start-->
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="client-profile.html">
                                    <i class="fa fa-tasks text-warning" aria-hidden="true"></i><em
                                        class="text-white">Project Profile</em>
                                </a>
                            </li>
                        @endif
                        <!-- /end -->
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="{{ route('project-document') }}">
                                  <i class="fa fa-file-word-o text-warning"></i><em class="text-white">Project
                                        Documents</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="{{ route('project-technical.index') }}">
                                  <i class="fa fa-cog text-warning" aria-hidden="true"></i><em
                                        class="text-white">Project Technical</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('payment_history'))
                            <li>
                                <a class="s-sidebar__nav-link" href="#0">
                                  <i class="fa fa-money text-warning"></i><em class="text-white">Project Payment
                                        History</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="/call-log.html">
                                    <i class="fa fa-street-view text-warning"></i><em class="text-white">360 Degree
                                        View</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="/feedback.html">
                                    <i class="fa fa-dashcube text-warning"></i><em class="text-white">Dashboard
                                        Widget</em>
                                </a>
                            </li>
                        @endif
                        @if (auth()->guard('admins')->check() && auth()->guard('admins')->user()->hasPermission('usermanagement'))
                            <li>
                                <a class="s-sidebar__nav-link" href="/payment.html">
                                    <i class="fa fa-bug text-warning"></i><em class="text-white">Reports
                                    </em>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
