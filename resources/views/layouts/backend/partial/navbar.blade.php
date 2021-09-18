<ul class="sidebar-menu">
    <li class="menu-header">Main</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.dashboard') }}"><i class="fas fa-fire"></i>&nbsp;<span>Dashboard</span></a></li>

    <li class="menu-header">Manage Human Resource</li>
    <li class="{{ (Request::segment(2) == 'users') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.users.index') }}"><i class="fas fa-user-lock"></i>&nbsp;<span>Administrator</span></a></li>

    <li class="menu-header">Manage Services</li>
    <li class="{{ (Request::segment(3) == 'types') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.businesses.types.index') }}"><i class="fas fa-bullseye"></i>&nbsp;<span>Type</span></a></li>
    <li class="{{ (Request::segment(3) == 'categories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.businesses.categories.index') }}"><i class="fas fa-tag"></i>&nbsp;<span>Category</span></a></li>
    
    {{-- <li class="menu-header">Manage Customers</li>
    <li class="{{ (Request::segment(1) == 'customers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customers.index') }}"><i class="fas fa-users"></i>&nbsp;<span>Customer</span></a></li>
    
    <li class="menu-header">Manage Product</li>
    <li class="{{ (Request::segment(1) == 'categories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tag"></i>&nbsp;<span>Category</span></a></li>
    <li class="{{ (Request::segment(1) == 'subcategories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('subcategories.index') }}"><i class="fas fa-tags"></i>&nbsp;<span>Subcategory</span></a></li>
    <li class="{{ (Request::segment(1) == 'units') ? 'active' : '' }}"><a class="nav-link" href="{{ route('units.index') }}"><i class="fas fa-square"></i>&nbsp;<span>Unit</span></a></li>
    <li class="{{ (Request::segment(1) == 'processes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('processes.index') }}"><i class="fas fa-project-diagram"></i>&nbsp;<span>Process</span></a></li>
    <li class="{{ (Request::segment(1) == 'products') ? 'active' : '' }}"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box"></i>&nbsp;<span>Product</span></a></li> --}}
</ul>