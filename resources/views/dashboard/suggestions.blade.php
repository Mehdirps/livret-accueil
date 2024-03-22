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
    </div>
@endsection
