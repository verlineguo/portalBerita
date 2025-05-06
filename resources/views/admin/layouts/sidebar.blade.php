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
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">ADMIN</li>
        <li class="{{ request()->routeIs('admin.post.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.post.manage') }}">
                <div class="parent-icon"><i class='bx bx-spreadsheet'></i>
                </div>
                <div class="menu-title">Post</div>
            </a>
        </li>


        <li class="{{ request()->routeIs(patterns: 'admin.category.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.category.manage') }}">
                <div class="parent-icon"><i class='bx bx-category-alt'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.advertisement.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.advertisement.manage') }}">
                <div class="parent-icon"><i class='bx bx-broadcast'></i>
                </div>
                <div class="menu-title">Advertisement</div>
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.contact.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.contact.manage') }}">
                <div class="parent-icon"><i class='bx bx-phone-call'></i>
                </div>
                <div class="menu-title">Contact</div>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.newsletter.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.newsletter.manage') }}">
                <div class="parent-icon"><i class='bx bx-news'></i>
                </div>
                <div class="menu-title">Newsletter</div>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.comment.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.comment.index') }}">
                <div class="parent-icon"><i class='bx bx-chat'></i>
                </div>
                <div class="menu-title">Comment</div>
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.tag.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.tag.manage') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Tag</div>
            </a>
        </li>



        <li class="{{ request()->routeIs('admin.user.manage') ? 'active' : '' }}">
            <a href="{{ route('admin.user.manage') }}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">User</div>
            </a>
        </li>
    </ul>
</div>
