<div class="modal fade" id="addBackgroundModal" tabindex="-1" aria-labelledby="addBackgroundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBackgroundModalLabel">Ajouter un fond d'écran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBackgroundForm" enctype="multipart/form-data" action="{{route('admin.backgrounds.add')}}" method="post">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="file" class="form-label">Fichier</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="background_group_id" class="form-label">Groupe</label>
                        <select id="background_group_id" class="form-select" name="background_group_id" required>
                            <option disabled selected>Choisir un groupe</option>
                            @foreach($background_group as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('background_group_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <button type="submit" class="btn btn-primary" id="saveBackgroundButton">Enregistrer</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
