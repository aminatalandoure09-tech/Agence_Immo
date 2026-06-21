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
            <a href="/demandes" class="nav-link text-white">
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
            <a href="/infos" class="nav-link text-white">
                <i class="bi bi-info-circle"></i>
                <span class="text">Infos</span>
            </a>
        </li>

    </ul>
   <form action="{{ route('deconnexion') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-link nav-link text-white d-inline p-0" style="vertical-align: baseline;">
        Déconnexion
    </button>
</form>

</div>