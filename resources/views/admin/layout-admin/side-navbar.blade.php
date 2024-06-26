<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='index.html'>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                 y="0px"
                 width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                 xml:space="preserve">
            <path d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
              C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z"/>
                <path d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
              c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z"/>
                <path d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
              c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z"/>
          </svg>

            <span class="align-middle me-3">AppStack</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Apps
            </li>
            <li class="sidebar-item {{ request()->is('admin/company-profile*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('company-profile.index')}}'>
                    <i class="align-middle" data-lucide="home"></i> <span
                            class="align-middle">Company Profile</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/article*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('article.index')}}'>
                    <i class="align-middle" data-lucide="paperclip"></i> <span
                            class="align-middle">Article</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/brand*') || request()->is('admin/product*') ? ' active' : '' }}">
                <a data-bs-target="#projects" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span
                            class="align-middle">Setting Product</span>
                </a>
                <ul id="projects"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->is('admin/brand*') || request()->is('admin/product*')  ? ' show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->is('admin/brand*')  ? ' active' : '' }}">
                        <a
                                class='sidebar-link' href='{{route('brand.index')}}'>Brand &
                            Category</a>
                    </li>
                    <li class="sidebar-item {{request()->is('admin/product*')  ? ' active' : ''}}"><a
                                class='sidebar-link' href='{{route('product.index')}}'>Product</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('admin/head-office*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('head-office.index')}}'>
                    <i class="align-middle" data-lucide="home"></i> <span
                            class="align-middle">Branches</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/sales-executive*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('sales-executive.index')}}'>
                    <i class="align-middle" data-lucide="star"></i> <span
                            class="align-middle">Sales Executive</span>
                </a>
            </li>
            <li class="sidebar-header">
                Footer
            </li>
            <li class="sidebar-item {{ request()->is('admin/about*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('about.edit',1)}}'>
                    <i class="align-middle" data-lucide="sticky-note"></i> <span
                            class="align-middle">About</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/sosmed*') ? ' active' : '' }}">
                <a class='sidebar-link' href='{{route('sosmed.edit',1)}}'>
                    <i class="align-middle" data-lucide="list"></i>
                    <span class="align-middle">Social Media</span>
                </a>
            </li>
        </ul>

    </div>
</nav>