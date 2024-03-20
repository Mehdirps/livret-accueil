<div class="modal fade" id="wifiModal" tabindex="-1" aria-labelledby="wifiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wifiModalLabel">WiFi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pour vous connecter à notre réseau Wifi, veuillez accéder aux paramètres Wifi de votre appareil</p>
                @if(!$livret->wifi->isEmpty())
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livret->wifi as $item)
                            <tr>
                                <td>{{$item->ssid}}</td>
                                <td>{{$item->password}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
