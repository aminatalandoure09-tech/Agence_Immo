<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ASANO SERVICES</title>
  <style>
    body{
    margin:0;
    background:#e5e7eb;
}
.navbar{
    position: fixed;
    top: 0;
    left: 0;

    width: 100%;
    z-index: 1000;
}

.sidebar{
    position: fixed;
    top: 56px; /* hauteur navbar */
    left: 0;

    width: 250px;
    height: calc(100vh - 56px);

    background-color: #07142e;

    overflow-y: auto;
}

.content{
    margin-top: 70px;
    margin-left: 250px;
    padding: 20px;
}

.sidebar .nav-link{
    font-size:22px;
    padding:15px 25px;
}

.sidebar .nav-link:hover{
    background:#1976D2;
}
.navbar {
    backdrop-filter: blur(8px);
}
.content{
    flex:1;
}
  </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@include('layouts.navbar')

<div class="d-flex">

    @include('layouts.sidebar')

    <main class="content p-4">
        @yield('content')
    </main>

</div>

</body>
</html>