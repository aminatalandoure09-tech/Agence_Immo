<div class="sidebar fixed-left" id="sidebar">

    <div class="text-end p-2">
        <button class="btn btn-outline-light btn-sm" id="toggleBtn">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="/" class="nav-link text-white">
                <i class="bi bi-house-fill"></i>
                <span class="text">Accueil</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ Route('logements.index') }}" class="nav-link text-white">
                <i class="bi bi-building"></i>
                <span class="text">Logement</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ Route('terrains.index') }}" class="nav-link text-white">
                <i class="bi bi-map"></i>
                <span class="text">Terrain</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rendezvous.index') }}" class="nav-link text-white">
                <i class="bi bi-card-checklist"></i>
                <span class="text">Demandes</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ Route('dashboard') }}" class="nav-link text-white">
                <i class="bi bi-shield-lock"></i>
                <span class="text">Admin</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ Route('infos') }}" class="nav-link text-white">
                <i class="bi bi-info-circle"></i>
                <span class="text">Infos</span>
            </a>
        </li>

        <!-- Section Dynamique : Connexion / Déconnexion -->
        <li class="nav-item">
            @auth
                <form action="{{ route('deconnexion') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="nav-link text-start btn w-100 border-0 text-white bg-transparent p-0 d-flex align-items-center" style="font-size: 1rem;">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <span class="text ms-2">Déconnexion</span>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="nav-link text-white d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right text-success"></i>
                    <span class="text ms-2">Connexion</span>
                </a>
            @endguest
        </li>
        
    </ul>

</div>