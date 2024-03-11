<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Jumbotron example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body>

<main>
    <div class="container py-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Home</a> <!-- Lien vers la page d'accueil -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Lien vers la page de connexion -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h1 class="text-center" style="margin-bottom: 30px;">{{ $event->title }}</h1>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5"><!-- Utilisez cette div pour afficher l'image -->
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $event->image) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block mw-100 mh-100" alt="Event Image" style="width: 900px; height: 500px;">
                    <button class="btn btn-warning ms-3">Acheter un ticket</button>
                </div>
            </div>
        </div>




        <div class="row align-items-md-stretch"><!--est dans cette dive afficher tout les infrmation de evenement plus un buutton de acchte tiket de evenet an finet de div-->
            <div class="col-md-10">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Titre: {{ $event->title }}</h2>
                    <p>Description: {{ $event->description }}</p>
                    <p>Date: {{ $event->date }}</p>
                    <p>Lieu: {{ $event->location }}</p>
                    <!-- Ajoutez d'autres informations de l'événement ici selon vos besoins -->
                </div>
            </div>



            <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021
        </footer>
    </div>
</main>



</body>
</html>
