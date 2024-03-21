@extends('layouts.app')

@section('app_title', 'Conditions Générales d\'Utilisation')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Conditions Générales d'Utilisation</h1>

        <div class="accordion" id="cguAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1. Objet
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#cguAccordion">
                    <div class="accordion-body">
                        Ces conditions régissent l'inscription et l'utilisation de notre application. En vous inscrivant, vous acceptez ces conditions.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2. Inscription
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#cguAccordion">
                    <div class="accordion-body">
                        Les utilisateurs s'inscrivent pour créer le livret d'accueil de leur établissement afin de fournir toutes les informations nécessaires à leurs clients.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3. Respect des autres utilisateurs
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#cguAccordion">
                    <div class="accordion-body">
                        Les utilisateurs doivent se comporter de manière respectueuse envers les autres utilisateurs. Tout comportement abusif peut entraîner la suspension ou la résiliation du compte.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        4. Contenu interdit
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#cguAccordion">
                    <div class="accordion-body">
                        Il est interdit de publier du contenu qui est illégal, offensant, diffamatoire, menaçant, ou qui enfreint les droits d'autrui. Tout contenu interdit sera supprimé et peut entraîner la suspension ou la résiliation du compte.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        5. Modifications des conditions
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#cguAccordion">
                    <div class="accordion-body">
                        Nous nous réservons le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés de toute modification importante.
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-warning mt-4" role="alert">
            Nous nous réservons le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés de toute modification importante.
        </div>
    </div>
@endsection
