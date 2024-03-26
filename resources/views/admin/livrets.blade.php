@extends('layouts.admin')

@section('admin_title', 'Les livrets')

@section('admin_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Les livrets</h1>
                <form action="{{route('admin.livret.searchLivrets')}}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher un livret"
                               aria-label="Rechercher un livret" aria-describedby="button-addon2" name="search">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Rechercher</button>
                    </div>
                </form>
                {{-- <a href="{{route('admin.livrets.create')}}" class="btn btn-primary">Ajouter un livret</a>--}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Nom de l'établissement</th>
                            <th>Adresse de l'établissement</th>
                            <th>Téléphone de l'établissement</th>
                            <th>Email de l'établissement</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($livrets) > 0)
                            @foreach($livrets as $livret)
                                <tr>
                                    <td>{{$livret->livret_name}}</td>
                                    <td>{{$livret->description}}</td>
                                    <td>{{$livret->establishment_name}}</td>
                                    <td>{{$livret->establishment_address}}</td>
                                    <td>{{$livret->establishment_phone}}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="{{route('livret.show',[$livret->slug, $livret->id])}}"> <i
                                                class="bi bi-eye"></i></a>
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
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Aucun livret trouvé</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @include('inc.pagination', ['paginator' => $livrets])
                    @foreach($livrets as $livret)
                        @include('admin.partials.update_livret_modal')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
