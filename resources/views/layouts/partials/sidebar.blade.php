<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-text">
                <a href="{{ route('dashboard') }}" class="nav-link nav-brand">
                    @if(get_setting('site_logo'))
                        <img src="{{ asset('storage/upload/'.get_setting('site_logo')) }}" alt="Logo">
                    @else
                        {{ get_setting('site_name') }}
                    @endif
                </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather sidebarCollapse feather-chevrons-left">
                    <polyline points="11 17 6 12 11 7"></polyline>
                    <polyline points="18 17 13 12 18 7"></polyline>
                </svg>
            </li>
        </ul>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="sidebarMenuWrapper">
            <li class="menu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="dropdown-toggle"
                   aria-expanded="{{ request()->routeIs('dashboard') ? 'true' : 'false' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            @can('customer_view')
                <li class="menu {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <a href="#customer-management" data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('customers.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>{{ __('Customer Management') }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('customers.*') ? 'show' : '' }}"
                        id="customer-management"
                        data-parent="#sidebarMenuWrapper">
                        @can('customer_view')
                            <li class="{{ request()->routeIs('customers.index') ? 'active' : '' }}">
                                <a href="{{ route('customers.index') }}">All Customers</a>
                            </li>
                        @endcan
                        @can('customer_create')
                            <li class="{{ request()->routeIs('customers.create') ? 'active' : '' }}">
                                <a href="{{ route('customers.create') }}">Add New</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('user_view')
                <li class="menu {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="#staff-members" data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>{{ __('User Management') }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('users.*') ? 'show' : '' }}"
                        id="staff-members"
                        data-parent="#sidebarMenuWrapper">
                        @can('user_view')
                            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}">All Users</a>
                            </li>
                        @endcan
                        @can('user_create')
                            <li class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                                <a href="{{ route('users.create') }}">Add New</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li class="menu {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <a href="#settings" data-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('settings.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span>Settings</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled {{ request()->routeIs('settings.*') ? 'show' : '' }}"
                    id="settings"
                    data-parent="#sidebarMenuWrapper">
                    @can('general_settings')
                        <li class="{{ request()->routeIs('settings.general.index') ? 'active' : '' }}">
                            <a href="{{ route('settings.general.index') }}">General Settings</a>
                        </li>
                    @endcan
                    @can('profile_settings')
                        <li class="{{ request()->routeIs('settings.profile.index') ? 'active' : '' }}">
                            <a href="{{ route('settings.profile.index') }}">Profile</a>
                        </li>
                    @endcan
                    @can('role_permission_view')
                        <li class="{{ request()->routeIs('settings.roles.*') ? 'active' : '' }}">
                            <a href="{{ route('settings.roles.index') }}">Role & Permissions</a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>

    </nav>

</div>
