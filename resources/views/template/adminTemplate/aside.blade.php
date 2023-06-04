{{--<link rel="stylesheet" href="{{ asset("assets/css/aside.css") }}">--}}

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('adminHome') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link " href="{{ route('notificationMag') }}">
                <i class="bi bi-grid"></i>
                <span>Notification</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('venteParMois') }}">
                <i class="bi bi-grid"></i>
                <span>VENTE PAR MOIS</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('addPointVentePage') }}">
                <i class="bi bi-grid"></i>
                <span>Point De vente</span>
            </a>
        </li>

        <li class="nav-item">
            <div class="dropdown">

                <a class="nav-link dropdown-toggle" href="#" role="button" id="materiel" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Materiel</span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="materiel">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="{{ route('processeur') }}"><i class="bi bi-plus-square-fill"></i>Processeur</a></li>
                    <li><a class="dropdown-item" href="{{ route('dur') }}"><i class="bi bi-plus-square-fill"></i>Dur</a></li>
                    <li><a class="dropdown-item" href="{{ route('ecran') }}"><i class="bi bi-plus-square-fill"></i>Ecran</a></li>
                    <li><a class="dropdown-item" href="{{ route('ram') }}"><i class="bi bi-plus-square-fill"></i>Ram</a></li>
                </ul>
            </div>

        </li>

        <li class="nav-item">
            <div class="dropdown">

                <a class="nav-link dropdown-toggle" href="#" role="button" id="laptop" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>LAPTOP</span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="laptop">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="{{ route('addLaptopPage') }}"><i class="bi bi-plus-square-fill"></i>AJOUTER</a></li>
                    <li><a class="dropdown-item" href="{{ route('laptops') }}"><i class="bi bi-plus-square-fill"></i>LISTES</a></li>
                </ul>
            </div>

        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('affectationPage') }}">
                <i class="bi bi-grid"></i>
                <span>AFFECTATION</span>
            </a>
        </li>

        <li class="nav-item">
            <div class="dropdown">

                <a class="nav-link dropdown-toggle" href="#" role="button" id="stock" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>STOCK</span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="stock">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="{{ route('achatPage') }}"><i class="bi bi-plus-square-fill"></i>ACHAT</a></li>
                    <li><a class="dropdown-item" href=""><i class="bi bi-plus-square-fill"></i>LISTES</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('transfertPage') }}">
                <i class="bi bi-grid"></i>
                <span>TRANSFERT LP</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
