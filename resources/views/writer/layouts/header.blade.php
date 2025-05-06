<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
             
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-bell"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="alert-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                        @include('components.notification-dropdown')
                    </li>
                    
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (auth()->user()->profile_picture)
                        <img src="{{ asset('storage/profile-images/' . auth()->user()->profile_picture) }}"
                            alt="{{ auth()->user()->name }}" class="rounded-circle bg-primary" width="48">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff&size=128&rounded=true"
                            alt="{{ auth()->user()->name }}" class="rounded-circle bg-primary" width="48">
                    @endif
                    <div class="user-info ps-2">
                        <p class="user-name mb-0">{{ Auth::user()->name ?? 'Guest' }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('writer.profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                  
                    <li><a class="dropdown-item" href="javascript:;"><i
                                class='bx bx-home-circle'></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <li>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle'></i><span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>
