<div class="col-12">
    <h2><i class="bi bi-info-circle"></i> Les informations du livret</h2>
    <form action="{{ route('dashboard.profile.update_livret') }}" method="post" class="p-5 bg-light rounded"
          enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="livret_name" class="form-label"><i class="bi bi-building"></i>Nom du livret</label>
            <input type="text" class="form-control" id="livret_name"
                   name="livret_name" required value="{{old('livret_name', $livret->livret_name)}}">
            @error('livret_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description" class="form-label"><i class="bi bi-clipboard"></i> Description du
                livret</label>
            <textarea class="form-control" id="description" name="description" required
                      rows="3">{{old('description', $livret->description)}}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <div class="form-group">
            <label for="establishment_type">Type d'établissement</label>
            <select class="form-control" id="establishment_type" name="establishment_type" required>
                <option disabled>-- Choisissez un type d'établissement --</option>
                <option value="camping" @if($livret->establishment_type == 'camping') selected @endif>Un camping
                </option>
                <option value="chambre_hotes" @if($livret->establishment_type == 'chambre_hotes') selected @endif>Une
                    chambre d'hôtes
                </option>
                <option value="b&b" @if($livret->establishment_type == 'b&b') selected @endif>Une conciergerie B&B
                </option>
                <option value="location" @if($livret->establishment_type == 'location') selected @endif>Un gestionnaire
                    de location
                </option>
                <option value="particulier" @if($livret->establishment_type == 'particulier') selected @endif>Un
                    particulier
                </option>
                <option value="gite" @if($livret->establishment_type == 'gite') selected @endif>Un gîte</option>
                <option value="hotel" @if($livret->establishment_type == 'hotel') selected @endif>Un hôtel</option>
            </select>
            @error('establishment_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="establishment_name" class="form-label"><i class="bi bi-building"></i> Nom de
                        l'établissement</label>
                    <input type="text" class="form-control" id="establishment_name"
                           name="establishment_name" required
                           value="{{old('establishment_name', $livret->establishment_name)}}">
                    @error('establishment_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="establishment_address" class="form-label"><i class="bi bi-geo-alt"></i>
                        Adresse de l'établissement</label>
                    <input type="text" class="form-control" id="establishment_address"
                           name="establishment_address" required
                           value="{{old('establishment_address', $livret->establishment_address)}}">
                    @error('establishment_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="establishment_phone" class="form-label"><i class="bi bi-telephone"></i>
                        Téléphone de l'établissement</label>
                    <input type="text" class="form-control" id="establishment_phone"
                           name="establishment_phone" required
                           value="{{old('establishment_phone', $livret->establishment_phone)}}">
                    @error('establishment_phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="establishment_email" class="form-label"><i class="bi bi-envelope"></i> Email
                        de l'établissement</label>
                    <input type="email" class="form-control" id="establishment_email"
                           name="establishment_email" required
                           value="{{old('establishment_email', $livret->establishment_email)}}">
                    @error('establishment_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="establishment_website" class="form-label"><i class="bi bi-globe"></i> Site
                        web de l'établissement</label>
                    <input type="text" class="form-control" id="establishment_website"
                           name="establishment_website" required
                           value="{{old('establishment_website', $livret->establishment_website)}}">
                    @error('establishment_website')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                @if($livret->logo)
                    <p>Logo actuel</p>
                    <figure style="border-radius: 50%; overflow: hidden;width: 100px">
                        <img src="{{asset($livret->logo)}}" alt="logo" class="img-thumbnail"
                             style="width: 100px;object-fit: cover">
                    </figure>
                @endif
                <label for="logo">Changer mon logo</label>
                <input type="file" class="form-control" id="logo" name="logo" aria-describedby="logoHelp">
                <small id="logoHelp" class="form-text text-muted">Seuls les fichiers PNG, JPG, JPEG et WEBP sont
                    autorisés</small>
                @error('logo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Mettre à jour mon livret d'accueil</button>
    </form>
</div>
