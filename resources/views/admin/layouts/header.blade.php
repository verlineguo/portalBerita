<style>
    /* Search bar styles */
    .search-bar {
        position: relative;
        transition: all 0.3s ease;
    }

    .search-bar-box {
        background-color: #f8f9fa;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .search-control {
        background-color: transparent;
        border: 1px solid #e9ecef;
        padding-left: 40px;
        padding-right: 40px;
        height: 38px;
    }

    .search-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
    }

    .search-show,
    .search-close {
        cursor: pointer;
        color: #6c757d;
        width: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        left: 0;
    }

    .search-close {
        left: auto;
        right: 0;
        display: none;
    }

    .search-active .search-close {
        display: flex;
    }

    .search-results {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #e9ecef;
        border-top: none;
    }

    .search-results .search-section {
        margin-bottom: 10px;
    }

    .search-results h6.bg-light {
        background-color: #f8f9fa;
        font-weight: 600;
        margin-bottom: 0;
    }

    .search-results .list-group-item {
        padding: 0.5rem 1rem;
        border-left: none;
        border-right: none;
    }

    .search-results .list-group-item:last-child {
        border-bottom: none;
    }

    .search-results a {
        color: #495057;
        text-decoration: none;
        display: block;
    }

    .search-results a:hover {
        color: #6366f1;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .search-bar {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            width: 100%;
            padding: 0 15px;
            background: #fff;
            z-index: 999;
            display: none;
        }

        .search-active {
            display: block;
        }
    }
</style>
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <!-- Add this in your header.blade.php file, near the end before closing body tag -->

            <!-- Make sure your search bar HTML looks like this -->
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> 
                    <span class="position-absolute top-50 search-show translate-middle-y">
                        <i class='bx bx-search'></i>
                    </span>
                    <span class="position-absolute top-50 search-close translate-middle-y">
                        <i class='bx bx-x'></i>
                    </span>
                </div>
                <!-- Search results will be inserted here dynamically -->
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-bell"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="alert-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                        @include('components.notification-dropdown')
                    </li>


                </ul>
            </div>
            <div class="user-box dropdown ps-3">
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
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i
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



