@extends('layouts.dashboard')

@section('dashboard_title', 'Statistiques')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Mes suggestions</h2>
        @if(!$livret->suggest)
            <div class="alert alert-warning" role="alert">
                Les suggestions ne sont pas activées sur votre livret
            </div>
            <a href="{{ route('dashboard.suggestion.enable', $livret->id) }}" class="text-white btn btn-success">Activer
                les suggestions</a>
        @else
            <div class="alert alert-success" role="alert">
                Les suggestions sont activées sur votre livret
            </div>
            <a href="{{ route('dashboard.suggestion.enable', $livret->id) }}" class="text-white btn btn-danger">Désactiver
                les suggestions</a>
        @endif
        @if(count($livret->suggestions) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($livret->suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->nom }}</td>
                        <td>{{ $suggestion->email }}</td>
                        <td>{{ $suggestion->title }}</td>
                        <td>{{ $suggestion->message }}</td>
                        <td>
                            @if($suggestion->status == 'pending')
                                <span class="badge badge-warning">En attente</span>
                            @elseif($suggestion->status == 'accepted')
                                <span class="badge badge-success">Accepté</span>
                            @else
                                <span class="badge badge-danger">Refusé</span>
                            @endif
                        </td>
                        {{--<td>
                            <a href="{{ route('dashboard.suggestion.delete', $suggestion->id) }}"
                               class="btn btn-danger">Supprimer</a>
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection