@extends('Admin.layout')

@section('content')
    <div class="container-fluid" style="padding: 50px; width: 900px;">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session()->has('success'))
                    <div class="alert alert-success" style="max-width: 700px;">
                        {{ session()->get('success') }}
                    </div>
                @endif

                    @if(session()->has('successUpdate'))
                        <div class="alert alert-success" style="max-width: 700px;">
                            {{ session()->get('successUpdate') }}
                        </div>
                    @endif


                    <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Nom de la catégorie</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody style="width: 700px;">
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('edit.cat', $category->id) }}"class="btn btn-warning">Edit</a>
                                <form action="{{ route('delete.cat', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
