<div class="modal fade" id="homeInfosModal" tabindex="-1" aria-labelledby="homeInfosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wifiModalLabel">Ajouter/modifier le mot d'accueil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
