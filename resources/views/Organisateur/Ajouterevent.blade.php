@extends('Admin.layout')

@section('title', 'Ajouter un événement')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Ajouter un événement</h1>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre de l'événement</label>
                                        <input type="text" class="form-control" id="titre" name="titre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombre_tickets" class="form-label">Nombre de tickets disponibles</label>
                                        <input type="number" class="form-control" id="nombre_tickets" name="nombre_tickets">
                                    </div>
                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix du ticket</label>
                                        <input type="number" class="form-control" id="prix" name="prix">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image de l'événement</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
