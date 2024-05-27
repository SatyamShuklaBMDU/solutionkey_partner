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
                            <a class="s-sidebar__nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fa fa-tachometer text-warning"></i><em class="text-white">Dashbord</em>
                            </a>
                        </li>
                        <li>
                            <a class="s-sidebar__nav-link {{ request()->routeIs('appointment.index') ? 'active' : '' }}" href="{{ route('appointment.index') }}">
                                <i class="fa-solid fa-user text-warning"></i><em class="text-white">Appointment</em>
                            </a>
                        </li>
                        <li>
                            <a class="s-sidebar__nav-link {{ request()->routeIs('total.earning') ? 'active' : '' }}" href="{{ route('total.earning') }}">
                                <i class="fas fa-indian-rupee-sign text-warning"></i><em class="text-white">Total
                                    Earnings</em>
                            </a>
                        </li>
                        <li>
                            <a class="s-sidebar__nav-link {{ request()->routeIs('income.wallet') ? 'active' : '' }}" href="{{ route('income.wallet') }}">
                                <i class="fas fa-wallet text-warning"></i><em class="text-white">Income Wallet</em>
                            </a>
                        </li>
                        <li>
                            <a class="s-sidebar__nav-link {{ request()->routeIs('withdraw.index') ? 'active' : '' }}" href="{{ route('withdraw.index') }}">
                                <i class="fas fa-indian-rupee-sign text-warning"></i><em
                                    class="text-white">Withdraw</em>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
