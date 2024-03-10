@extends('Organisateur.layout')

@section('content')
    <div class="container-fluid" style="padding: 50px;">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="text-center" style="margin-bottom: 30px;">Modifier un événement</h1>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre de l'événement</label>
                                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ $event->title }}">
                                        @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ $event->description }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $event->date }}">
                                        @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombre_tickets" class="form-label">Nombre de tickets disponibles</label>
                                        <input type="number" class="form-control @error('nombre_tickets') is-invalid @enderror" id="nombre_tickets" name="nombre_tickets" value="{{ $event->available_seats }}">
                                        @error('nombre_tickets')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix du ticket</label>
                                        <input type="number" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" value="{{ $event->price }}">
                                        @error('prix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image de l'événement</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
