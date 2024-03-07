@extends('layouts.dashboard')

@section('dashboard_title', 'Mon profil')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Mon profil</h1>
                <p>Vous êtes connecté en tant que <strong>{{$user->civility}} {{ Auth::user()->name }}</strong></p>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
            @include('dashboard.partials.user_infos')
            @include('dashboard.partials.livret_infos')
        </div>
    </div>
@endsection
