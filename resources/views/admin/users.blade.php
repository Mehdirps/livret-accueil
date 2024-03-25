@extends('layouts.admin')

@section('admin_title', 'Liste des utilisateurs')

@section('admin_content')
    <h1>Listes des utilisateurs</h1>
    <form action="{{ route('admin.user.searchUsers') }}" method="GET" class="col-md-4">
        <p>Rechercher un/des utilisateur(s)</p>
        <input class="form-control" type="text" name="search" required placeholder="Par nom, email etc..">
        <button type="submit" class="btn btn-secondary">Rechercher</button>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Civilité</th>
                <th>Date de naissance</th>
                <th>Créé le</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            <img src="{{asset($user->avatar)}}" alt="{{$user->name}}" class="img-thumbnail"
                                 style="width: 100px;">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->civility}}</td>
                        <td>{{$user->birth_date}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->active ? 'Oui' : 'Non'}}</td>
                        <td>
                            <form action="{{route('admin.user.enable', $user->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('get')
                                @if($user->active)
                                    <button type="submit" class="btn btn-danger">Désactiver</button>
                                @else
                                    <button type="submit" class="btn btn-success">Activer</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#updateModal_{{$user->id}}">
                                Modifier
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11">Aucun utilisateur trouvé</td>
                </tr>
            @endif
            </tbody>
        </table>
        @include('inc.pagination', ['paginator' => $users])
        @foreach($users as $user)
            @include('admin.partials.update_user_modal')
        @endforeach
    </div>
@endsection
