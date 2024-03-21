<div class="modal fade" id="placesGroupsModal" tabindex="-1" aria-labelledby="placesGroupsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="placesGroupsModalLabel">Lieux à proximité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center">
                @foreach($livret->placeGroups as $group)
                    @if(!$group->nearbyPlaces->isEmpty())
                        <div class="card mb-3 w-50 h-100">
                            <div class="card-header text-center">
                                {{ $group->name }}
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($group->nearbyPlaces as $place)
                                    <li class="list-group-item">
                                        <h6 class="mb-1">{{ $place->name }}</h6>
                                        <p class="mb-0">{{ $place->address }}</p>
                                        <p class="mb-0">{{ $place->description }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
