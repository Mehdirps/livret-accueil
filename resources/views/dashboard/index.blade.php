@extends('layouts.dashboard')
@section('dashboard_title', 'Bienvenue sur le livret d\'accueil')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Bienvenue sur votre livret d'accueil - <strong>{{$livret->livret_name}}</strong></h1>
                <p>Vous êtes actuellement sur le livret d'accueil de votre entreprise. Vous pouvez consulter les
                    informations importantes de votre entreprise, les documents à lire, les formations à suivre,
                    etc.</p>
                <p>Vous pouvez également consulter les statistiques de votre entreprise, les informations importantes,
                    etc.</p>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
        </div>
        <div class="col-12">
            <h2>Comment fonctionne l'application</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Comment modifier mes informations et celle de mon livret ?
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pour modifier vos informations, vous devez vous rendre dans la section "Mon profil" de votre
                            compte. Vous pouvez modifier votre nom, prénom, email, mot de passe, etc. Pour modifier les
                            informations de votre livret, vous devez vous rendre dans la section "Mon profil". Vous
                            pouvez modifier le nom de votre livret, la description, ajout un logo etc.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Comment changer le fond d'écran de mon livret ?
                        </button>
                    </h3>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pour changer le fond d'écran de votre livret, vous devez vous rendre dans la section "Mon
                            livret d'accueil" de votre compte. Vous pouvez choisir un fond parmis les images
                            disponibles. Plusieurs catégories d'images sont disponibles.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Comment fonctionne les statistiques ?
                        </button>
                    </h3>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Les statistiques vous permettent de voir le nombre de vue de votre livret en vous rendant dans la section "Statistiques" de votre compte. Vous pouvez voir le nombre de vues par jour, par semaine, par mois, et sélectionner une période personnalisée.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFoor" aria-expanded="false" aria-controls="collapseFoor">
                            Comment voir mon livret en tant qu'utilisateur ?
                        </button>
                    </h3>
                    <div id="collapseFoor" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pour voir votre livret en tant qu'utilisateur, vous devez vous rendre dans la section "Mon livret d'accueil" de votre compte et cliquer sur "voir"..
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Comment nous contacter ?
                        </button>
                    </h3>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pour nous contacter, rien de plus simple. Cliquez sur le bouton "Nous contacter" en bas de la page et remplissez le formulaire de contact. Nous vous recontacterons dans les plus brefs délais.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
