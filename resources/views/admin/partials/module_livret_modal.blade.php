<div class="modal fade" id="moduleLivretModal_{{$livret->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleLivretModal_{{$livret->id}}">Editer le livret -
                    <strong>{{$livret->livret_name}}</strong></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Wifi</h3>
                            @if(!$livret->wifi->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Code</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->wifi as $item)
                                        <tr>
                                            <td>{{$item->ssid}}</td>
                                            <td>{{$item->password}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.wifi.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h3>Digicode</h3>
                            @if(!$livret->digicode->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Code</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->digicode as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->code}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.digicode.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Groupes de lieux</h3>
                            @if(!$livret->placeGroups->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->placeGroups as $group)
                                        <tr>
                                            <td>{{ $group->name }}</td>
                                            <td>
                                                <form action="{{route('dashboard.module.places_groups.delete', $group->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h3>Autour de moi</h3>
                            @if(!$livret->nearbyPlaces->isEmpty())
                                <div class="table-responsive">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Téléphone</th>
                                            <th>Temps de trajet</th>
                                            <th>Description</th>
                                            <th>Groupe</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($livret->nearbyPlaces as $place)
                                            <tr>
                                                <td>{{ $place->name }}</td>
                                                <td>{{ $place->address }}</td>
                                                <td>{{ $place->phone }}</td>
                                                <td>{{ $place->travel_time }}</td>
                                                <td>{{ $place->description }}</td>
                                                <td>{{ $place->placeGroup->name }}</td>
                                                <td>
                                                    <form
                                                        action="{{route('dashboard.module.nearby_places.delete', $place->id)}}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('get')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Numéro utiles</h3>
                            @if(!$livret->utilsPhone->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Numéro</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->utilsPhone as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->number}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.utils_phone.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h3>Infos pratiques</h3>
                            @if(!$livret->utilsInfos->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Infos</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->utilsInfos as $item)
                                        <tr>
                                            <td>{{$item->sub_name}}</td>
                                            <td>{{$item->text}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.utils_infos.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Info arrivée</h3>
                            @if(!$livret->startInfos->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Infos</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->startInfos as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->text}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.start_info.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h3>Info départ</h3>
                            @if(!$livret->endInfos->isEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Infos</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($livret->endInfos as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->text}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Editer</a>
                                                <form action="{{route('dashboard.module.end_info.delete', $item->id)}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Mot d'accueil</h3>
                            <form id="wifiForm" action="{{route('dashboard.module.home_infos')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Titre</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $livret->homeInfos ? $livret->homeInfos->name : '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">Message</label>
                                    <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text', $livret->homeInfos ? $livret->homeInfos->text : '') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" id="saveWifi">Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
