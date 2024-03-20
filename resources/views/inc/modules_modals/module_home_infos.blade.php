<div class="modal fade" id="homeInfosModal" tabindex="-1" aria-labelledby="homeInfosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="mb-3">Bienvenue !</h4>
                @if($livret->homeInfos)
                    <h5 class="mb-2 text-primary">{{ $livret->homeInfos->name }}</h5>
                    <p class="lead">{{ $livret->homeInfos->text }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
