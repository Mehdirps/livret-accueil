@extends('layouts.admin')

@section('admin_title', 'Les livrets')

@section('admin_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Les livrets</h1>
               {{-- <a href="{{route('admin.livrets.create')}}" class="btn btn-primary">Ajouter un livret</a>--}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livrets as $livret)
                            <tr>
                                <td>{{$livret->livret_name}}</td>
                                <td>{{$livret->description}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('livret.show',[$livret->slug, $livret->id])}}"> <i class="bi bi-eye"></i></a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#updateLivretModal_{{$livret->id}}">
                                        <i class="bi bi-pen"></i>
                                    </button>
                                   {{-- <a href="{{route('admin.livrets.edit', $livret->id)}}"
                                       class="btn btn-warning">Modifier</a>
                                    <form action="{{route('admin.livrets.destroy', $livret->id)}}" method="post"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @foreach($livrets as $livret)
                        @include('admin.partials.update_livret_modal')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection