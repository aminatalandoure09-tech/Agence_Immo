@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Terrains</title>

<style>
body{
    background:#e5e5e5;
    font-family: Arial, sans-serif;
}

.container{
    display:flex;
    justify-content:center;
    gap:40px;
    margin-top:50px;
    flex-wrap:wrap;
}

.card{
    width:350px;
    background:#081133;
    padding:20px;
    border-radius:8px;
}

.card img{
    width:100%;
    height:250px;
    object-fit:cover;
}

.card-content{
    color:white;
    margin-top:15px;
}

.card-content h3{
    margin:0;
    font-size:20px;
    font-weight:normal;
}

.card-content p{
    margin:5px 0;
    font-size:18px;
}

.btn{
    display:block;
    width:80%;
    margin:25px auto 10px;
    text-align:center;
    background:#2ecc71;
    color:white;
    text-decoration:none;
    padding:15px;
    border-radius:5px;
    font-size:18px;
    font-weight:bold;
}

.btn:hover{
    background:#27ae60;
}
</style>
</head>

<body>

<div class="container">

    <div class="card">
        <img src="/images/terrain2.jpg" alt="Terrain Acceuil">

        <div class="card-content">
            <h3>Terrain situé Sotuba Village</h3>
            <p>prix: 7 000 000 fcfa</p>
            <p>superficie: 800 m²</p>
        </div>

        <a href="/rendezvous" class="btn">Prendre rendez-vous</a>
    </div>

    <div class="card">
        <img src="/images/terrain.jpg" alt="Terrain Niamana">
        <div class="card-content">
            <h3>Terrain situé Niamana</h3>
            <p>prix: 5 000 000 fcfa</p>
            <p>superficie: 920 m²</p>
        </div>

        <a href="/rendezvous" class="btn">Prendre rendez-vous</a>
    </div>

</div>

</body>
</html>
@endsection,