<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <svg width="200" height="60" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="60" fill="#ffffff" />
                <text x="10" y="40" font-family="Segoe UI, sans-serif" font-size="28" fill="#1a1a1a">
                    <tspan fill="#e63946" font-weight="bold">Berita</tspan>kan
                </text>
            </svg>
        </div>

        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ request()->routeIs('writer.dashboard') ? 'active' : '' }}">
            <a href="{{ route('writer.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Writer</li>
        <li class="{{ request()->routeIs('writer.post.manage') ? 'active' : '' }}">
            <a href="{{ route('writer.post.manage') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Post</div>
            </a>
        </li>
        <li class="{{ request()->routeIs('writer.comments') ? 'active' : '' }}">
            <a href="{{ route('writer.comments') }}">
                <div class="parent-icon"><i class='bx bx-spreadsheet'></i>
                </div>
                <div class="menu-title">Comment</div>
            </a>
        </li>






    </ul>

</div>
