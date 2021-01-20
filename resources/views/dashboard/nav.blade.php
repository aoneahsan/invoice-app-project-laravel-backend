<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light prospect-sidebar" id="sidebar">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="/home">
            <!-- <img src="{{ asset('img/prospect-logo.png') }}" class="navbar-brand-img 
          mx-auto" alt="..."> -->
            <h1 class="text-primary">INVOICES</h1>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            @auth
            <!-- Navigation -->
            <ul class="navbar-nav prospect-sidebar-nav">
                
                    
               
                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoice.list')}}">
                        <i class="fe fe-aperture"></i> Invoices List
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoice.create')}}">
                        <i class="fe fe-aperture"></i> Create Invoice
                    </a>
                </li>

            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->



            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="ml-4 btn btn-outline-primary w-75" href="/home">
                        <i class="fe fe-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="ml-4 btn btn-outline-danger w-75" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fe fe-log-out"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>

            <!-- Push content down -->
            <div class="mt-auto"></div>

            @else

                <!-- Navigation -->
                <ul class="navbar-nav prospect-sidebar-nav">
        
            
        
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">
                            <i class="fe fe-aperture"></i> Login
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">
                            <i class="fe fe-aperture"></i> Register
                        </a>
                    </li>
    
                </ul>

            @endauth


        </div> <!-- / .navbar-collapse -->

    </div>
</nav>