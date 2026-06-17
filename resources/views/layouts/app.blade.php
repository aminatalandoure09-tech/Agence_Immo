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

.sidebar{
    width:250px;
    min-height:100vh;
    background:#06112d;
    padding-top:20px;
}

.sidebar .nav-link{
    font-size:22px;
    padding:15px 25px;
}

.sidebar .nav-link:hover{
    background:#0d6efd;
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