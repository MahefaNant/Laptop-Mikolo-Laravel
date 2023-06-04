{{--<link rel="stylesheet" href="{{ asset("assets/css/aside.css") }}">--}}

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('userHomePage') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link " href="{{ route('notification') }}">
                <i class="bi bi-grid"></i>
                <span>Notification</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('stockPointDeVente') }}">
                <i class="bi bi-grid"></i>
                <span>Stock</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('ventesEffectuee') }}">
                <i class="bi bi-grid"></i>
                <span>Vente Effectuee</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
