<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Election</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ພາບລວມລະບົບ
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="/subjects"
                        class="nav-link {{ Request::is('subjects') || Request::is('dashboard/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list text-info"></i>
                        <p>
                            ຫົວຂໍ້
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users"
                        class="nav-link {{ Request::is('users') || Request::is('editUser/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user text-info"></i>
                        <p>
                            ຜູ້ໃຊ້
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="w" style="position: fixed;bottom: 0;">
            <a href="{{ route('logout') }}" class="btn btn-danger w-100 px-5" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" {{ __('Logout') }}><i
                    class="fa fa-sign-out pull-right"></i>
                ອອກຈາກລະບົບ</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
