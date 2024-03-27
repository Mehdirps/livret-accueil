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
                            <hr>
                            <h3 class="display-4">Wifi</h3>
                            <h4>Ajouter un wifi</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.wifi')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="wifiName" class="form-label">Nom du WiFi</label>
                                    <input type="text" class="form-control" id="wifiName" name="wifiName"
                                           value="{{ old('wifiName')}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="wifiPassword" class="form-label">Mot de passe du WiFi</label>
                                    <input type="text" class="form-control" id="wifiPassword" name="wifiPassword"
                                           value="{{ old('wifiPassword') }}" required>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveWifi">Sauvegarder</button>
                            </form>
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
                            <hr>
                            <h3 class="display-4">Digicode</h3>
                            <h4>Ajouter un digicode</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.digicode')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ old('code')}}"
                                           required>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                            </form>
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
                            <hr>
                            <h3 class="display-4">Groupes de lieux</h3>
                            <h4>Ajouter un groupe de lieux</h4>
                            <form action="{{route('dashboard.module.places_groups')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="groupName" class="form-label">Nom du groupe</label>
                                    <input type="text" class="form-control" id="groupName" name="groupName"
                                           value="{{ old('groupName')}}" required>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary">Ajouter un groupe</button>
                            </form>
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
                                                <form
                                                    action="{{route('dashboard.module.places_groups.delete', $group->id)}}"
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
                            <hr>
                            <h3 class="display-4">Autour de moi</h3>
                            <h4>Ajouter un lieu</h4>
                            <form action="{{route('dashboard.module.nearby_places')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="placeName" class="form-label">Nom du lieu</label>
                                    <input type="text" class="form-control" id="placeName" name="placeName"
                                           value="{{ old('placeName')}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="placeGroup" class="form-label">Groupe</label>
                                    <select class="form-control" id="placeGroup" name="placeGroup" required>
                                        <option selected disabled>-- Choisir un groupe --</option>
                                        @foreach($livret->placeGroups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="placeAddress" class="form-label">Adresse du lieu</label>
                                    <input type="text" class="form-control" id="placeAddress" name="placeAddress"
                                           value="{{ old('placeAddress')}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="placePhone" class="form-label">Téléphone du lieu</label>
                                    <input type="text" class="form-control" id="placePhone" name="placePhone"
                                           value="{{ old('placePhone')}}">
                                </div>
                                <div class="mb-3">
                                    <label for="travelTime" class="form-label">Temps de trajet</label>
                                    <input type="text" class="form-control" id="travelTime" name="travelTime"
                                           value="{{ old('travelTime')}}">
                                </div>
                                <div class="mb-3">
                                    <label for="placeDescription" class="form-label">Description du lieu</label>
                                    <textarea class="form-control" id="placeDescription" name="placeDescription"
                                    >{{ old('placeDescription')}}</textarea>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary">Ajouter un lieu</button>
                            </form>
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
                            <hr>
                            <h3 class="display-4">Numéros utiles</h3>
                            <h4>Ajouter un numéro utile</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.utils_phone')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Numéro</label>
                                    <input type="text" class="form-control" id="number" name="number"
                                           value="{{ old('number')}}"
                                           required>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                            </form>
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
                                                <form
                                                    action="{{route('dashboard.module.utils_phone.delete', $item->id)}}"
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
                            <hr>
                            <h3 class="display-4">Infos pratiques</h3>
                            <h4>Ajouter une info pratique</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.utils_infos')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="sub_name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="sub_name" name="sub_name"
                                           value="{{ old('sub_name') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">Texte</label>
                                    <textarea class="form-control" id="text" name="text"
                                              required>{{ old('text') }}</textarea>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                            </form>
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
                                                <form
                                                    action="{{route('dashboard.module.utils_infos.delete', $item->id)}}"
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
                            <hr>
                            <h3 class="display-4">Info arrivée</h3>
                            <h4>Ajouter une info d'arrivée</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.start_info')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">Texte</label>
                                    <textarea class="form-control" id="text" name="text"
                                              required>{{ old('text') }}</textarea>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                            </form>
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
                                                <form
                                                    action="{{route('dashboard.module.start_info.delete', $item->id)}}"
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
                            <hr>
                            <h3 class="display-4">Info départ</h3>
                            <h4>Ajouter une info de départ</h4>
                            <form id="wifiForm" action="{{route('dashboard.module.end_info')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">Texte</label>
                                    <textarea class="form-control" id="text" name="text"
                                              required>{{ old('text') }}</textarea>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                            </form>
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
                            <hr>
                            <h3 class="display-4">Mot d'accueil</h3>
                            <form id="wifiForm" action="{{route('dashboard.module.home_infos')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Titre</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $livret->homeInfos ? $livret->homeInfos->name : '') }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">Message</label>
                                    <textarea class="form-control" id="text" name="text" rows="3"
                                              required>{{ old('text', $livret->homeInfos ? $livret->homeInfos->text : '') }}</textarea>
                                </div>
                                <input type="hidden" name="livret_id" value="{{$livret->id}}">
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
