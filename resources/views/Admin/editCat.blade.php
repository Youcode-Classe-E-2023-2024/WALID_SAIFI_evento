@extends('Admin.layout');

@section('content')




    <div class="container-fluid">
        <div class="row">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit un catégoriser</h1>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <form action="{{ route('update.cat', ['id' => $category->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Nom de catégoriser</label>
                                        <input type="text" class="form-control"  name="name" value="{{$category->name}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>



@endsection
