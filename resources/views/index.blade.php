@extends('layouts.app')

@section('app_title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bienvenue sur le livret d'accueil</h1>
                <p>Vous trouverez ici toutes les informations nécessaires pour bien démarrer votre expérience chez
                    nous.</p>
            </div>
            <div class="col-md-6">
                <button id="show-signup-form" class="btn btn-primary">Inscription</button>
                <button id="show-login-form" class="btn btn-secondary">Connexion</button>
                @include('auth.login')
                @include('auth.register')
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function () {
            $('#show-signup-form').click(function () {
                $('#signup-form').removeClass('d-none');
                $('#login-form').addClass('d-none');
                $(this).addClass('btn-primary');
                $(this).removeClass('btn-secondary');
                $('#show-login-form').removeClass('btn-primary');
                $('#show-login-form').addClass('btn-secondary');
            });

            $('#show-login-form').click(function () {
                $('#login-form').removeClass('d-none');
                $('#signup-form').addClass('d-none');
                $(this).addClass('btn-primary');
                $(this).removeClass('btn-secondary');
                $('#show-signup-form').removeClass('btn-primary');
                $('#show-signup-form').addClass('btn-secondary');
            });
        });
    </script>
@endsection
