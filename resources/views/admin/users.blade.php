@extends('layouts.admin')

@section('admin_title', 'Liste des utilisateurs')

@section('admin_content')
    <h1>Listes des utilisateurs</h1>

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
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        <img src="{{asset($user->avatar)}}" alt="{{$user->name}}" class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->civility}}</td>
                    <td>{{$user->birth_date}}</td>
                    <td>{{$user->created_at->format('d/m/Y H:i')}}</td>
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
