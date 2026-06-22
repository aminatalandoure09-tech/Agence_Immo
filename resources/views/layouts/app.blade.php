<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASANO SERVICES</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            background: #e5e7eb;
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* 1. NAVBAR FIXE ET IMMOBILE */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            z-index: 1050; /* Doit être au-dessus de la sidebar */
        }

        /* CONTENEUR GLOBAL */
        .main-wrapper {
            display: flex;
            margin-top: 70px; /* Évite que le contenu passe sous la navbar de 70px */
        }

        /* 2. SIDEBAR STATIQUE / FIXE À GAUCHE */
        .sidebar {
            position: fixed;
            top: 70px; /* Démarre juste en dessous de la navbar */
            left: 0;
            bottom: 0;
            width: 200px;
            background: #0F172A;
            transition: all .3s ease;
            z-index: 1000;
            overflow-y: auto; /* Permet un défilement interne à la sidebar si trop de liens */
        }

        /* Sidebar repliée */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: #1976D2;
        }

        .sidebar.collapsed .text {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        .sidebar.collapsed .nav-link i {
            font-size: 1.2rem;
        }

        /* 3. ZONE DE CONTENU DYNAMIQUE QUI DÉFILE PROPREMENT */
        .content {
            flex: 1;
            padding: 25px;
            margin-left: 200px; /* Décale le contenu pour ne pas qu'il se cache sous la sidebar */
            transition: all .3s ease;
            min-height: calc(100vh - 70px);
        }

        /* Quand la sidebar se replie, la zone de texte s'agrandit automatiquement */
        .sidebar.collapsed + .content {
            margin-left: 70px;
        }

    </style>

</head>

<body>

    @include('layouts.navbar')

    <div class="main-wrapper">

        @include('layouts.sidebar')
        
        <main class="content">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('toggleBtn');
            const sidebar = document.getElementById('sidebar');

            if (btn && sidebar) {
                btn.addEventListener('click', function () {
                    sidebar.classList.toggle('collapsed');
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>