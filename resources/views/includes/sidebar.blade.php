<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('assets/images/logo.png')}}" class="header-brand-img" title="RADMIN"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);

        $user = auth()->user();
        $requisitions = get_requisitions(0);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item ">
                    <a href="#">
                        @if($user->hasRole(['super-admin', 'admin']))
                            <img src="{{ asset('assets/images/admin.png') }}" alt="Profile" class="rounded-circle mr-3" width="40" height="40">
                        @else
                            <img src="{{ asset('assets/images/user.png')}}" alt="Profile" class="rounded-circle mr-3" width="40" height="40">
                        @endif
                        <span class="text-md text-white">Hello, {{ $user->f_name }}</span> 
                    </a>
                </div>
                <div class="dropdown-divider" style="border-top:1px solid grey"></div>
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'requests') ? 'active' : '' }}">
                    <a href="{{url('requests')}}"><i class="ik ik-repeat"></i><span>{{ __('Requests') }}</span> 
                        @if($user->hasRole(['super-admin', 'hod-agm-gm', 'director', 'ceo']) && $requisitions->count() > 0)
                            <span class=" badge badge-danger badge-right">{{ $requisitions->count() }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permissions' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    @if($user->hasRole(['super-admin', 'admin', 'hod-agm-gm']))
                        <div class="submenu-content">
                            <!-- only those have manage_user permission will get access -->
                            @can('manage users')
                                <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                            @endcan
                            <!-- only those have manage_role permission will get access -->
                            @can('manage roles')
                                <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                            @endcan
                            <!-- only those have manage_permission permission will get access -->
                            @can('manage permissions')
                                <a href="{{url('permissions')}}" class="menu-item {{ ($segment1 == 'permissions') ? 'active' : '' }}">{{ __('Permissions')}}</a>
                            @endcan
                        </div>
                    @endif
                </div>

                <div class="nav-item">
                    <a href="#"><i class="ik ik-settings"></i><span>{{ __('Settings')}}</span></a>
                </div>

            </nav>   
                
        </div>
    </div>
</div>