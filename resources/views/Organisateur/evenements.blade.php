@extends('Organisateur.layout')

@section('content')
    <div class="container-fluid" style="padding: 50px;">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="text-center" style="margin-bottom: 30px;">Mes événements</h1>

                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach($events as $event)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img src="{{ asset('storage/' . $event->image) }}" class="bd-placeholder-img card-img-top" alt="Your Image" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <div class="card-body">
                                            <p class="card-text">{{ $event->title }}</p>
                                            <p class="card-text">Date de création: {{ $event->created_at->format('d/m/Y') }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                                </div>
                                                <small class="text-muted">9 mins</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
