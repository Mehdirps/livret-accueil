@extends('layouts.dashboard')
@section('dashboard_title', 'Changement de fond')

@section('dashboard_content')
    <style>
        .card {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: 0.3s;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .card h2{
            font-size: 1rem;
        }
        .card i {
            font-size: 3rem;
        }
    </style>
    <h1>Editer le livret - <strong>{{$livret->livret_name}}</strong></h1>
    <div class="row container">
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-wifi"></i>
                <h2>Wifi</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-key"></i>
                <h2>Digicode</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-geo-alt"></i>
                <h2>Autour de moi</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-telephone"></i>
                <h2>Numéros utiles</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-info-circle"></i>
                <h2>Infos pratiques</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-arrow-up-right"></i>
                <h2>Info arrivée</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-arrow-down-left"></i>
                <h2>Info départ</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <i class="bi bi-envelope"></i>
                <h2>Mot d'accueil</h2>
            </div>
        </div>
    </div>
@endsection
