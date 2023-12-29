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
                            @if(Auth::user()->isAdmin == 1) 
                            &nbsp;Admin

                            @else
                            &nbsp;User
                            @endif
                            
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="" class="text-white"><i class="icon-cog3"></i></a>
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
                    <a href="" class="nav-link ">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                    <li
                        class="nav-item nav-item-submenu ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> Administrative</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Administrative">

            
                                <li
                                    class="nav-item nav-item-submenu ">

                                    <a href="#"
                                        class="nav-link ">Payments</a>

                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Create
                                                Payment</a></li>
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Manage
                                                Payments</a></li>
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Student
                                                Payments</a></li>
                                    </ul>
                                </li>
                                <li
                                    class="nav-item nav-item-submenu ">

                                    <a href="#"
                                        class="nav-link ">Accounts</a>

                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Expenses</a>
                                        </li>
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Utility
                                                Bills</a></li>
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Income</a>
                                        </li>
                                        <li class="nav-item"><a href=""
                                                class="nav-link ">Salaries</a>
                                        </li>
                                        <li>
                                        <li class="nav-item nav-item-submenu">
                                            <a href="#" class="nav-link ">Reports</a>
                                            <ul class="nav nav-group-sub">
                                                <li class="nav-item"><a href=""
                                                        class="nav-link ">Expense</a>
                                                </li>
                                                <li class="nav-item"><a href=""
                                                        class="nav-link">Utility</a>
                                                </li>
                                                <li class="nav-item"><a href=""
                                                        class="nav-link ">Income</a>
                                                </li>
                                                <li class="nav-item"><a href=""
                                                        class="nav-link ">Salary</a>
                                                </li>
                                            </ul>
                                        </li>
                                </li>
                        </ul>
                    </li>
                
            </ul>
            </li>
            

            {{-- Manage Students --}}
        
                <li
                    class="nav-item nav-item-submenu  ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> Students</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        {{-- Admit Student --}}
                        
                            <li class="nav-item">
                                <a href=""
                                    class="nav-link ">Admit
                                    Student</a>
                            </li>
                        

                        {{-- Student Information --}}
                        <li
                            class="nav-item nav-item-submenu">
                            <a href="#"
                                class="nav-link ">Student
                                Information</a>
                           
                        </li>

                        
                            {{-- Student Promotion --}}
                            <li
                                class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}">
                                <a href="#"
                                    class="nav-link ">Student
                                    Promotion</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href=""
                                            class="nav-link ">Promote
                                            Students</a></li>
                                    <li class="nav-item"><a href=""
                                            class="nav-link ">Manage
                                            Promotions</a></li>
                                </ul>

                            </li>

                            {{-- Student Graduated --}}
                            <li class="nav-item"><a href=""
                                    class="nav-link">Students
                                    Graduated</a></li>
                            <li class="nav-item"><a href=""
                                    class="nav-link ">Send
                                    Message to Parents</a></li>
                        

                    </ul>
                </li>
                
        </div>
    </div>
</div>
