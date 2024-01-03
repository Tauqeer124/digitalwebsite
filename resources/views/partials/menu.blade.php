<div class="sidebar sidebar-dark bg-success sidebar-main sidebar-expand-md" style="background-color: #133d67!important">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    {{-- <div class="mr-3">
                        <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                    </div>  --}}

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i>
                            &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Academics --}}
                @if (Auth::user()->isAdmin == 1)
                    <li
                        class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['package.index', 'package.edit', 'package.card', 'package.destroy']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> Academics</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">
                            {{-- Timetables --}}
                            <li class="nav-item"><a href="{{ route('package.index') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['package.index']) ? 'active' : '' }}">Packages</a>
                            </li>
                        </ul>
                    </li>
            

            @endif

            

            {{-- End Exam --}}
            @if(auth()->user()->isAdmin == 1)
            <li class="nav-item">
                <a href="{{ route('show.payments') }}"
                    class="nav-link {{ in_array(Route::currentRouteName(), ['payments']) ? 'active' : '' }}"><i
                    class="fas fa-dollar-sign"></i> <span>Payments</span></a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('show.wallet') }}"
                    class="nav-link {{ in_array(Route::currentRouteName(), ['wallet']) ? 'active' : '' }}"><i
                        class="icon-book"></i> <span>My Wallet</span></a>
            </li>
            @if(Auth::user()->isAdmin == 0)
            <li class="nav-item">
                <a href="{{ route('package.card') }}" class="nav-link {{ Route::is('package.card') ? 'active' : '' }}">
                    <i class="icon-link"></i>
                    <span>Package</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('show.link') }}" class="nav-link {{ Route::is('show.link') ? 'active' : '' }}">
                    <i class="icon-link"></i>
                    <span>Get Referal Link</span>
                </a>
            </li>
        @endif

            {{-- Manage Account --}}
            <li class="nav-item">
                <a href="{{ route('my_account') }}"
                    class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i
                        class="icon-user"></i> <span>My Account</span></a>
            </li>

            </ul>
        </div>
    </div>
</div>
