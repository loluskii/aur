<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapse" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.orders.index') }}">
                <i class="bi bi-card-list"></i>
                <span>Orders</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link active collapsed" data-bs-target="#c" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="c" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="">
                        <i class="bi bi-circle"></i><span>All Orders</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link active collapsed" data-bs-target="#e" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="e" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index') }}" class="">
                        <i class="bi bi-circle"></i><span>All Users</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="" class="">
                        <i class="bi bi-circle"></i><span>Blocked Users</span>
                    </a>
                </li> --}}
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#d" data-bs-toggle="collapse" href="#">
                <i class="bi bi-shop-window"></i><span>Store Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="d" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.products.index') }}" class="">
                        <i class="bi bi-circle"></i><span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.category.index') }}" class="">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.orders.index') }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Blog</span>
            </a>
        </li>
        
        
        {{-- <li class="nav-item">
            <a class="nav-link active collapsed" data-bs-target="#f" data-bs-toggle="collapse" href="#">
                <i class="bi bi-grid-1x2"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fe" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="">
                        <i class="bi bi-circle"></i><span>All Posts</span>
                    </a>
                </li>
                <li>
                    <a href="" class="">
                        <i class="bi bi-circle"></i><span>All Posts</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        
        <li class="nav-item">
            <a class="nav-link active collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-envelope"></i><span>Newsletter</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.newsletter.index') }}" class="">
                        <i class="bi bi-circle"></i><span>Subscribers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.newsletter.create') }}" class="">
                        <i class="bi bi-circle"></i><span>Send Mail</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item">
            <a class="nav-link " href="">
                <i class="bi bi-gear"></i>
                <span>Content Management</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link " href="">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>

</aside>
