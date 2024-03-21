<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Partagez mon livret</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h2>Partagez votre livret d'accueil</h2>
                        <p>Vous pouvez partager votre livret d'accueil avec vos collègues, amis, famille, etc. Pour
                            cela,
                            vous devez copier le lien ci-dessous et le partager.</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"
                                   value="{{route('livret.show',[\Illuminate\Support\Facades\Auth::user()->livret->slug,\Illuminate\Support\Facades\Auth::user()->livret->id])}}"
                                   id="shareLink" readonly>
                            <button class="btn btn-primary" type="button" onclick="copyLink()">Copier</button>
                        </div>
                        <h3>Vous pouvez également le partager sur les réseaux sociaux</h3>
                        <div class="d-flex justify-content-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{route('livret.show',[\Illuminate\Support\Facades\Auth::user()->livret->slug,\Illuminate\Support\Facades\Auth::user()->livret->id])}}"
                               target="_blank" class="btn"><i class="bi bi-facebook"></i> Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{route('livret.show',[\Illuminate\Support\Facades\Auth::user()->livret->slug,\Illuminate\Support\Facades\Auth::user()->livret->id])}}"
                               target="_blank" class="btn"><i class="bi bi-twitter"></i> Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(route('livret.show',[\Illuminate\Support\Facades\Auth::user()->livret->slug,\Illuminate\Support\Facades\Auth::user()->livret->id]))}}&title=Mon%20livret&summary=Voici%20mon%20livret%20d'accueil"
                               target="_blank" class="btn"><i class="bi bi-linkedin"></i> LinkedIn</a>
                            <a href="https://api.whatsapp.com/send?text={{urlencode('Jetez un oeil à ce livret d\'accueil : ') . route('livret.show',[\Illuminate\Support\Facades\Auth::user()->livret->slug,\Illuminate\Support\Facades\Auth::user()->livret->id])}}"
                               target="_blank" class="btn"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
