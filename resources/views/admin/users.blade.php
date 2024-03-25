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
                    {{--<td>
                        <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary">Modifier</a>
                        <form action="{{route('admin.users.destroy', $user->id)}}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
