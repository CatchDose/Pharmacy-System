<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("index")}}" class="brand-link">
        <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pharmacy System</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("storage/avatars/" . auth()->user()->avatar_image)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route("profiles.edit",auth()->user()->id)}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                {{--Home Page--}}
                <li class="nav-item">
                    <a href="{{route("index")}}" class="nav-link {{ Route::currentRouteNamed('index') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>

                @role('admin')
                {{-- Users Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('users.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="bi bi-people-fill"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("users.index")}}" class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("users.create")}}" class="nav-link {{ Route::currentRouteNamed('users.create') ? 'active' : '' }}">
                                <i class="bi bi-person-add"></i>
                                <p>Add User</p>
                            </a>
                        </li>



                    </ul>
                </li>
                @endrole
                @hasanyrole("pharmacy|admin")
                {{-- Pharmacy Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('pharmacies.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link ">
                        <i class="bi bi-building"></i>
                        <p>
                            @role("admin") pharmacies @endrole
                            @role("pharmacy") pharmacy @endrole

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @role("admin")
                        <li class="nav-item">
                            <a href="{{route("pharmacies.index")}}" class="nav-link {{Route::is('pharmacies.index') ? 'active' : '' }}">
                                <i class="bi bi-list-columns"></i>
                                <p>All Pharmacies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("pharmacies.create")}}" class="nav-link {{Route::is('pharmacies.create') ? 'active' : '' }}">
                                <i class="bi bi-building-fill-add"></i>
                                <p>Add Pharmacy</p>
                            </a>
                        </li>
                        @endrole
                        @role("pharmacy")
                        <li class="nav-item">
                            <a href="{{route("pharmacies.show",Auth::user()->pharmacy->id)}}" class="nav-link {{Route::is('pharmacies.show') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Pharmacy</p>
                            </a>
                        </li>
                        @endrole

                    </ul>
                </li>
                @endhasanyrole

                @hasanyrole("pharmacy|admin")
                {{-- Doctors Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('doctors.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link ">
                        <i class="bi bi-people-fill"></i>
                        <p>
                            Doctors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("doctors.index")}}" class="nav-link {{Route::is('doctors.index') ? 'active' : '' }}">
                                <i class="bi bi-person-vcard"></i>
                                <p>All Doctors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("doctors.create")}}" class="nav-link {{Route::is('doctors.create') ? 'active' : '' }}">
                                <i class="bi bi-person-add"></i>
                                <p>Add Doctor</p>
                            </a>
                        </li>



                    </ul>
                </li>
                @endhasanyrole


                {{-- Orders Menu--}}
                <li class="nav-item">

                    <a href="#" class="nav-link">
                        <i class="bi bi-cart4"></i>
                        <p>
                            Orders
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link active">
                                <i class="bi bi-bag-fill"></i>
                                <p>All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orders.create')}}" class="nav-link">
                                <i class="bi bi-bag-plus"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>


                @role('admin')

                {{-- Areas Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('areas.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="bi bi-geo-alt"></i>
                        <p>
                            Areas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("areas.index")}}" class="nav-link {{ Route::currentRouteNamed('areas.index') ? 'active' : '' }}">
                                <i class="bi bi-globe-americas"></i>
                                <p>All Areas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('areas.create')}}" class="nav-link {{ Route::currentRouteNamed('areas.create') ? 'active' : '' }}">
                                <i class="bi bi-patch-plus"></i>
                                <p>Add Area</p>
                            </a>
                        </li>



                    </ul>
                </li>
                @endrole

                @role('admin')
                {{-- Addresses Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('addresses.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="bi bi-map"></i>
                        <p>
                            Addresses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('addresses.index')}}" class="nav-link {{ Route::currentRouteNamed('addresses.index') ? 'active' : '' }}">
                                <i class="bi bi-pin-map"></i>
                                <p>All Addresses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('addresses.create')}}" class="nav-link {{ Route::currentRouteNamed('addresses.create') ? 'active' : '' }}">
                                <i class="bi bi-node-plus"></i>
                                <p>Add Address</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                {{-- Medicines Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('medicines.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="bi bi-capsule"></i>
                        <p>
                            Medicines
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("medicines.index")}}" class="nav-link {{Route::is('medicines.index') ? 'active' : '' }}">
                                <i class="bi bi-capsule-pill"></i>
                                <p>All Medicines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("medicines.create")}}" class="nav-link {{Route::is('medicines.create') ? 'active' : '' }}">
                                <i class="bi bi-plus-square"></i>
                                <p>Add Medicine</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @hasanyrole("pharmacy|admin")
                {{-- Revenue Menu--}}
                <li class="nav-item">

                    <a href="#" class="nav-link">
                        <i class="bi bi-currency-exchange"></i>
                        <p>
                            Revenues
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @role("admin")
                        <li class="nav-item">
                            <a href="{{route("revenues.index")}}" class="nav-link {{Route::is('revenues.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pharmacies Revenues</p>
                            </a>
                        </li>
                        @endrole
                        @role("pharmacy")
                        <li class="nav-item">
                            <a href="{{route("revenues.index")}}" class="nav-link {{Route::is('revenues.index') ? 'active' : '' }}">
                                <i class="bi bi-cash-stack"></i>
                                <p>Pharmacy Revenue</p>
                            </a>
                        </li>
                        @endrole

                    </ul>
                </li>
                @endhasanyrole

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        <i class="bi bi-box-arrow-right"></i>
                        <p>logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>