<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASANO SERVICES</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body{
            margin:0;
            background:#e5e7eb;
        }

        /* NAVBAR */

        .navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            z-index:1000;
            height: 70px;
        }

        /* CONTENEUR */

        .main-wrapper{
            display:flex;
            margin-top:70px;
        }

        /* SIDEBAR */

        .sidebar{
            width:200px;
            min-height:calc(100vh - 70px);
            background:#0F172A;
            transition:all .3s ease;
            flex-shrink:0;
        }

        .sidebar.collapsed{
            width:70px;
        }

        .sidebar .nav-link{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 15px;
        }

        .sidebar .nav-link:hover{
            background:#1976D2;
        }

        .sidebar.collapsed .text{
            display:none;
        }

        .sidebar.collapsed .nav-link{
            justify-content:center;
        }

        .sidebar.collapsed .nav-link i{
            font-size:1.2rem;
        }

        /* CONTENU */

        .content{
            flex:1;
            padding:25px;
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

            btn.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
            });

        });

    </script>

</body>

</html>