<div class="modal fade" id="wifiModal" tabindex="-1" aria-labelledby="wifiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wifiModalLabel">Ajouter/Editer WiFi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="wifiForm" action="{{route('dashboard.module.wifi')}}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="livret_id" value="{{$livret->id}}">
                    <div class="mb-3">
                        <label for="wifiName" class="form-label">Nom du WiFi</label>
                        <input type="text" class="form-control" id="wifiName" name="wifiName" value="{{ old('wifiName', $livret->wifi ? $livret->wifi->ssid : '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="wifiPassword" class="form-label">Mot de passe du WiFi</label>
                        <input type="text" class="form-control" id="wifiPassword" name="wifiPassword" value="{{ old('wifiPassword', $livret->wifi ? $livret->wifi->password : '') }}" required>
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
