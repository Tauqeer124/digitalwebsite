<div class="navbar navbar-expand-md navbar-dark bg-primary" style="background-color:#133d67 !important; color: black !important; ">
    <div class="" >
        <a href="" class="d-inline-block">
            <img src="{{ asset('global_assets/images/gwlogo.png') }}" class="rounded-circle" width="80"  alt="">
        {{-- <h4 class="text-bold text-white">CHMSC SYSTEM</h4> --}}
        </a>
    </div>
   {{-- <div class="navbar-brand">
        <a href="" class="d-inline-block">
            <img src="{{ asset('global_assets/images/gwlogo.png') }}" alt="">
        </a>
    </div> --}}

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile" >
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>


        </ul>

			<span class="navbar-text ml-md-3 mr-md-auto"></span>

        <ul class="navbar-nav">

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <!-- <img style="width: 38px; height:38px;" src="" class="rounded-circle" alt="photo"> -->
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
