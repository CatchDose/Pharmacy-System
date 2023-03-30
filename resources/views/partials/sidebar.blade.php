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

                {{-- Users Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('users.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("users.index")}}" class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>all users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("users.create")}}" class="nav-link {{ Route::currentRouteNamed('users.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add user</p>
                            </a>
                        </li>



                    </ul>
                </li>


                {{-- Pharmacy Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('pharmacies.*') ? 'menu-open' : '' }}">
                    
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @role("admin") pharmacies @endrole 
                            @hasanyrole("pharmacy|doctor") pharmacy @endrole

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    @role("admin")  
                        <li class="nav-item">
                            <a href="{{route("pharmacies.index")}}" class="nav-link {{Route::is('pharmacies.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>all pharmacies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("pharmacies.create")}}" class="nav-link {{Route::is('pharmacies.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add pharmacy</p>
                            </a>
                        </li>
                        @endrole 
                    </ul>
                    @hasanyrole("pharmacy|doctor")
                    <li class="nav-item">
                        
                            <a href="{{route("pharmacies.show",Auth::user()->pharmacy->id)}}" class="nav-link {{Route::is('pharmacies.show') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>show pharmacy</p>
                            </a>
                        </li> 
                    @endrole 
                </li>


            
                {{-- Doctors Menu--}}
                <li class="nav-item">

                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            doctors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("doctors.index")}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>all doctors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("doctors.create")}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add doctor</p>
                            </a>
                        </li>



                    </ul>
                </li>


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
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orders.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit</p>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- Areas Menu--}}
                <li class="nav-item">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            areas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("areas.index")}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>all Areas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('areas.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add Area</p>
                            </a>
                        </li>



                    </ul>
                </li>


                {{-- Addresses Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('addresses.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            addresses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('addresses.index')}}" class="nav-link {{ Route::currentRouteNamed('addresses.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All addresses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('addresses.create')}}" class="nav-link {{ Route::currentRouteNamed('addresses.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add address</p>
                            </a>
                        </li>



                    </ul>
                </li>


                {{-- Medicines Menu--}}
                <li class="nav-item {{ Route::currentRouteNamed('medicines.*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            medicines
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("medicines.index")}}" class="nav-link {{Route::is('medicines.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All medicines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("medicines.create")}}" class="nav-link {{Route::is('medicines.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add medicine</p>
                            </a>
                        </li>



                    </ul>
                </li>

                {{-- Revenue Menu--}}
                <li class="nav-item">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            revenue
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>all users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add user</p>
                            </a>
                        </li>



                    </ul>
                </li>


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

                        <i class="far fa-circle nav-icon"></i>
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
