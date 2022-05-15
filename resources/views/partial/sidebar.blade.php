<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        @guest
        <div class="sidebar-brand-text mx-2">My Blog</div>    
        @endguest
        @auth
        <div class="sidebar-brand-text mx-2">{{auth()->user()->name}}</div>
        @endauth
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{Request::is('/')? 'active' : ''}}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>


    <!-- Nav Item - Categories -->
    <li class="nav-item {{Request::is('categories')? 'active' : ''}}">
        <a class="nav-link " href="{{route('categories.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Categories</span></a>
    </li>
    <!-- Nav Item - All Articles -->
    <li class="nav-item {{Request::is('articles')? 'active' : ''}}">
        <a class="nav-link " href="{{route('articles.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>All Articles</span></a>
    </li>
    <!-- Nav Item - My Articles -->
    <li class="nav-item {{Request::is('myarticles')? 'active' : ''}}">
        <a class="nav-link" href="{{route('myarticles')}}">
            <i class="fas fa-file-alt "></i>
            <span>My Articles</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    @guest
         <!-- Sidebar Message -->
    <div class="list-group mx-3">
        <a class="btn btn-primary btn-sm my-3" href="{{ route('register') }}">
            <i class="far fa-edit fa-sm fa-fw mr-2"></i>Regis</a>
        <a class="btn btn-success btn-sm" href="{{route('login')}}">
            <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2"></i>Login</a>
    </div>
    @endguest

   

</ul>