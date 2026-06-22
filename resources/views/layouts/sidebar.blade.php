<div class="sidebar fixed-left" id="sidebar">

    <div class="text-end p-2">
        <button class="btn btn-outline-light btn-sm" id="toggleBtn">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-house-fill me-2" style="font-size: 1.1rem;"></i>
                <span class="text">Accueil</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('logements.index') }}" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-building me-2" style="font-size: 1.1rem;"></i>
                <span class="text">Logement</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('terrains.index') }}" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-map me-2" style="font-size: 1.1rem;"></i>
                <span class="text">Terrain</span>
            </a>
        </li>

        @auth
            @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center fw-bold">
                        <i class="bi bi-speedometer2 text-warning me-2" style="font-size: 1.1rem;"></i>
                        <span class="text">Administrateur</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('rendezvous.index') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-card-checklist text-info me-2" style="font-size: 1.1rem;"></i>
                        <span class="text">Demandes</span>
                    </a>
                </li>
            @endif
        @endauth

        <li class="nav-item">
            <a href="{{ route('infos') }}" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-info-circle me-2" style="font-size: 1.1rem;"></i>
                <span class="text">Infos</span>
            </a>
        </li>

        <li class="nav-item mt-3">
            @auth
                <form action="{{ route('deconnexion') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="nav-link text-start btn w-100 border-0 text-white bg-transparent p-0 d-flex align-items-center" style="font-size: 1rem; padding-left: 1rem !important;">
                        <i class="bi bi-box-arrow-right text-danger" style="font-size: 1.2rem;"></i>
                        <span class="text ms-2">Déconnexion</span>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="nav-link text-white d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right text-success" style="font-size: 1.2rem;"></i>
                    <span class="text ms-2">Connexion</span>
                </a>
            @endguest
        </li>
        
    </ul>
</div>