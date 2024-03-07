@extends('layouts.dashboard')
@section('dashboard_title', 'Création du livret')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Création de votre livret d'accueil !</h1>
                <p>Vous êtes sur le point de créer votre livret d'accueil. Pour cela, veuillez remplir les informations
                    suivantes :</p>
                <form action="{{ route('dashboard.first_login') }}" method="post" class="p-5 bg-light rounded">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="livret_name" class="form-label"><i class="bi bi-building"></i>Nom du livret</label>
                        <input type="text" class="form-control" id="livret_name"
                               name="livret_name" required value="{{old('livret_name')}}">
                        @error('livret_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="establishment_type">Type d'établissement</label>
                        <select class="form-control" id="establishment_type" name="establishment_type" required>
                            <option disabled selected>-- Choisissez un type d'établissement --</option>
                            <option value="camping">Un camping</option>
                            <option value="chambre_hotes">Une chambre d'hôtes</option>
                            <option value="b&b">Une conciergerie B&B</option>
                            <option value="location">Un gestionnaire de location</option>
                            <option value="particulier">Un particulier</option>
                            <option value="gite">Un gîte</option>
                            <option value="hotel">Un hôtel</option>
                        </select>
                        @error('establishment_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="establishment_name" class="form-label"><i class="bi bi-building"></i> Nom de
                                    l'établissement</label>
                                <input type="text" class="form-control" id="establishment_name"
                                       name="establishment_name" required value="{{old('establishment_name')}}">
                                @error('establishment_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="establishment_address" class="form-label"><i class="bi bi-geo-alt"></i>
                                    Adresse de l'établissement</label>
                                <input type="text" class="form-control" id="establishment_address"
                                       name="establishment_address" required value="{{old('establishment_address')}}">
                                @error('establishment_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="establishment_phone" class="form-label"><i class="bi bi-telephone"></i>
                                    Téléphone de l'établissement</label>
                                <input type="text" class="form-control" id="establishment_phone"
                                       name="establishment_phone" required value="{{old('establishment_phone')}}">
                                @error('establishment_phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="establishment_email" class="form-label"><i class="bi bi-envelope"></i> Email
                                    de l'établissement</label>
                                <input type="email" class="form-control" id="establishment_email"
                                       name="establishment_email" required value="{{old('establishment_email')}}">
                                @error('establishment_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="establishment_website" class="form-label"><i class="bi bi-globe"></i> Site
                                    web de l'établissement</label>
                                <input type="text" class="form-control" id="establishment_website"
                                       name="establishment_website" required value="{{old('establishment_website')}}">
                                @error('establishment_website')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Créer mon livret d'accueil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
