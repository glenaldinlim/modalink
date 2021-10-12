<ul class="sidebar-menu">
    <li class="menu-header">Main</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.dashboard') }}"><i class="fas fa-fire"></i>&nbsp;<span>Dashboard</span></a></li>

    <li class="menu-header">Manage Human Resource</li>
    <li class="{{ (Request::segment(2) == 'users') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.users.index') }}"><i class="fas fa-user-lock"></i>&nbsp;<span>Administrator</span></a></li>

    <li class="menu-header">Manage Service</li>
    <li class="{{ (Request::segment(4) == 'types') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.businesses.types.index') }}"><i class="fas fa-bullseye"></i>&nbsp;<span>Business Type</span></a></li>
    <li class="{{ (Request::segment(4) == 'categories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.businesses.categories.index') }}"><i class="fas fa-tag"></i>&nbsp;<span>Business Category</span></a></li>
    <li class="{{ (Request::segment(3) == 'statuses') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.statuses.index') }}"><i class="fas fa-toggle-on"></i>&nbsp;<span>Status</span></a></li>
    <li class="{{ (Request::segment(3) == 'verification') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.verification.statuses.index') }}"><i class="fas fa-clipboard"></i>&nbsp;<span>Verification Status</span></a></li>
    
    <li class="menu-header">Manage Partner</li>
    <li class="{{ (Request::segment(2) == 'merchants') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.merchants.index') }}"><i class="fas fa-store"></i>&nbsp;<span>Merchant</span></a></li>
    
    <li class="menu-header">Manage Payment</li>
    <li class="{{ (Request::segment(2) == 'banks') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.banks.index') }}"><i class="fas fa-university"></i>&nbsp;<span>Bank</span></a></li>
    <li class="{{ (Request::segment(3) == 'methods') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.payments.methods.index') }}"><i class="fas fa-credit-card"></i>&nbsp;<span>Method</span></a></li>

    <li class="menu-header">Manage Funding</li>
    <li class="{{ (Request::segment(3) == 'types') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.funds.types.index') }}"><i class="fas fa-bullseye"></i>&nbsp;<span>Fund Type</span></a></li>
    <li class="{{ (Request::segment(2) == 'funds' && Request::segment(3) == 'statuses') ? 'active' : '' }}"><a class="nav-link" href="{{ route('backend.funds.statuses.index') }}"><i class="fas fa-clipboard"></i>&nbsp;<span>Fund Status</span></a></li>

    {{-- <li class="menu-header">Manage Customers</li>
    <li class="{{ (Request::segment(1) == 'customers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customers.index') }}"><i class="fas fa-users"></i>&nbsp;<span>Customer</span></a></li>
    
    <li class="menu-header">Manage Product</li>
    <li class="{{ (Request::segment(1) == 'categories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tag"></i>&nbsp;<span>Category</span></a></li>
    <li class="{{ (Request::segment(1) == 'subcategories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('subcategories.index') }}"><i class="fas fa-tags"></i>&nbsp;<span>Subcategory</span></a></li>
    <li class="{{ (Request::segment(1) == 'units') ? 'active' : '' }}"><a class="nav-link" href="{{ route('units.index') }}"><i class="fas fa-square"></i>&nbsp;<span>Unit</span></a></li>
    <li class="{{ (Request::segment(1) == 'processes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('processes.index') }}"><i class="fas fa-project-diagram"></i>&nbsp;<span>Process</span></a></li>
    <li class="{{ (Request::segment(1) == 'products') ? 'active' : '' }}"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box"></i>&nbsp;<span>Product</span></a></li> --}}
</ul>