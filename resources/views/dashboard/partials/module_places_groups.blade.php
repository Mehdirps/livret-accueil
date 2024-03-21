<div class="modal fade" id="placesGroupsModal" tabindex="-1" aria-labelledby="placesGroupsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="placesGroupsModalLabel">Ajouter un groupe et un lieu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h6>Groupes</h6>
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
                    <form action="{{route('dashboard.module.places_groups')}}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="livret_id" value="{{$livret->id}}">
                        <div class="mb-3">
                            <label for="groupName" class="form-label">Nom du groupe</label>
                            <input type="text" class="form-control" id="groupName" name="groupName"
                                   value="{{ old('groupName')}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter un groupe</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
