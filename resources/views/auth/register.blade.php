<form id="signup-form" action="{{route('home.register')}}" method="post">
    @csrf
    @method('post')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="last_name">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required
                   placeholder="Votre nom" value="{{old('last_name')}}">
            @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="first_name">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required
                   placeholder="Votre prénom" value="{{old('first_name')}}">
            @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        {{-- Fait un select pour choisir le type d'établissement d'accueil est l'utilisateur --}}
        <label for="establishment_type">Type d'établissement</label>
        <select class="form-control" id="establishment_type" name="establishment_type" required>
            <option disabled selected>-- Choisissez un type d'établissement --</option>
            <option value="camping">Un camping</option>
            <option value="chambre_hotes">Une chambre d'hôtes</option>
            <option value="b&b">Une conciergerie B&B</option>
            <option value="location">Un gestionnaire de location</option>
            <option value="particulier">Un particulier</option>
            <option value="gite">Un gîte</option>
            <option value="hotel">Un hôtel</option>
        </select>
        @error('establishment_type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" class="form-control" id="email" name="email" required
               placeholder="Votre adresse e-mail" value="{{old('email')}}">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password"
               required placeholder="Votre mot de passe">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmation du mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation"
               name="password_confirmation" required placeholder="Confirmez votre mot de passe">
        @error('password_confirmation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
