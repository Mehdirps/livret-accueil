<div class="modal fade" id="digicodeModal" tabindex="-1" aria-labelledby="digicodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="wifiModalLabel">Ajouter un digicode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="wifiForm" action="{{route('dashboard.module.digicode')}}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="livret_id" value="{{$livret->id}}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code')}}"
                                       required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="saveDigicode">Sauvegarder</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
