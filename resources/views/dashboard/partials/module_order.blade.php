<div class="modal fade" id="modulesOrderModal" tabindex="-1" aria-labelledby="modulesOrderModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modulesOrderModalLabel">Changer l'ordre des modules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ordre</th>
                        <th scope="col">Nom du module</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($livret->wifi->unique('order')->concat($livret->digicode->unique('order'))->concat($livret->endInfos->unique('order'))->concat($livret->utilsPhone->unique('order'))->concat($livret->startInfos->unique('order'))->concat($livret->utilsInfos->unique('order'))->concat($livret->NearbyPlaces->unique('order'))->sortBy('order') as $item)
                        <tr class="module_order_tr">
                            <td class="move_item"><i class="bi bi-arrows-move"></i></td>
                            <td>{{ $item->order }}</td>
                            <td>
                                @if($item instanceof App\Models\ModuleWifi)
                                    Wifi
                                @elseif($item instanceof App\Models\ModuleDigicode)
                                    Digicode
                                @elseif($item instanceof App\Models\ModuleEndInfos)
                                    Infos de départ
                                @elseif($item instanceof App\Models\ModuleUtilsPhone)
                                    Numéros utiles
                                @elseif($item instanceof App\Models\ModuleStartInfos)
                                    Infos de d'arrivée
                                @elseif($item instanceof App\Models\ModuleUtilsInfos)
                                    Infos utiles
                                @elseif($item instanceof App\Models\NearbyPlace)
                                    Lieux à proximité
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
