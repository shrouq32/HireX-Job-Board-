<header>
    <nav class="navbar logo navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
            <h1 class="m-0 text-primary">HireX</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                <a href="{{ url('/') }}#about" class="nav-item nav-link">About</a>

                @auth
                    @if(auth()->user()->role == 1)
                        <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                    @endif
                    @if(auth()->user()->role == 2)
                        <a href="{{ url('/myjobs') }}" class="nav-item nav-link">My Jobs</a>
                        <a href="{{ url('/resumes') }}" class="nav-item nav-link">Resumes</a>
                    @endif
                @endauth

                <a href="{{ url('/') }}#alljobs" class="nav-item nav-link">All Jobs</a>
                <a href="{{ url('/') }}#category" class="nav-item nav-link">Job Categories</a>
            </div>
            
            @auth
                @if(auth()->user()->role == 3 && auth()->user()->candidate)
                    <a href="{{ route('notifications.index') }}" class="nav-item nav-link">Notifications</a>
                @endif
            @endauth

            <div class="navbar-nav ms-auto mb-0 p-4 p-lg-0">
                @auth
                @if(auth()->user()->role == 2)
                <a href="{{ route('empprofile.showProfile') }}" class="nav-item nav-link">My Account</a>
                @endif
                @if(auth()->user()->role == 3)
                    @if(auth()->check() && auth()->user()->candidate)
                        <a href="{{ route('profile.candidate', auth()->user()->candidate->id) }}" class="nav-item nav-link">My Account</a>
                    @endif
                @endif

                    <form method="POST" action="{{ route('logout') }}" class="d-inline mb-0">
                        @csrf
                        <button type="submit" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block mb-0" style="margin-right: 0px;margin-bottom: 0px;">
                            Logout<i class="fa fa-sign-out-alt ms-3"></i>
                        </button>
                    </form>
                @else
                    @if (!Request::is('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 mb-0 px-lg-5 d-none d-lg-block" style="margin-right: 0px">
                            Login<i class="fa fa-arrow-right ms-3"></i>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
</header>


