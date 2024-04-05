<div class="modal fade" id="textDesignModal" tabindex="-1" aria-labelledby="textDesignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="textDesignModalLabel">Changer le design des textes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.update-text-design')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="fontColor" class="form-label">Couleur du texte</label>
                        <input type="color" class="form-control" id="fontColor" value="{{ $livret->text_color }}" name="fontColor">
                    </div>
                    <div class="mb-3">
                        <label for="fontFamily" class="form-label">Police d'écriture</label>
                        <select class="form-control" id="fontFamily" name="fontFamily">
                            <option style="font-family: 'Roboto', sans-serif;" {{ $livret->font == 'Roboto' ? 'selected' : '' }} value="Roboto">Roboto</option>
                            <option style="font-family: 'Open Sans', sans-serif;" {{ $livret->font == 'Open Sans' ? 'selected' : '' }} value="Open Sans">Open Sans</option>
                            <option style="font-family: 'Lato', sans-serif;" {{ $livret->font == 'Lato' ? 'selected' : '' }} value="Lato">Lato</option>
                            <option style="font-family: 'Montserrat', sans-serif;" {{ $livret->font == 'Montserrat' ? 'selected' : '' }} value="Montserrat">Montserrat</option>
                            <option style="font-family: 'Raleway', sans-serif;" {{ $livret->font == 'Raleway' ? 'selected' : '' }} value="Raleway">Raleway</option>
                            <option style="font-family: 'Oswald', sans-serif;" {{ $livret->font == 'Oswald' ? 'selected' : '' }} value="Oswald">Oswald</option>
                            <option style="font-family: 'Source Sans Pro', sans-serif;" {{ $livret->font == 'Source Sans Pro' ? 'selected' : '' }} value="Source Sans Pro">Source Sans Pro</option>
                            <option style="font-family: 'Poppins', sans-serif;" {{ $livret->font == 'Poppins' ? 'selected' : '' }} value="Poppins">Poppins</option>
                            <option style="font-family: 'Noto Sans', sans-serif;" {{ $livret->font == 'Noto Sans' ? 'selected' : '' }} value="Noto Sans">Noto Sans</option>
                            <option style="font-family: 'Ubuntu', sans-serif;" {{ $livret->font == 'Ubuntu' ? 'selected' : '' }} value="Ubuntu">Ubuntu</option>
                        </select>
                    </div>
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
