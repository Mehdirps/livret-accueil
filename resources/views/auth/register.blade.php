<form id="signup-form">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="first_name">Nom</label>
            <input type="email" class="form-control" id="first_name" name="first_name" required
                   placeholder="Votre nom">
        </div>
        <div class="form-group col-md-6">
            <label for="last_name">Prénom</label>
            <input type="email" class="form-control" id="last_name" name="last_name" required
                   placeholder="Votre prénom">
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
    </div>
    <div class="form-group">
        <label for="signup-email">Adresse email</label>
        <input type="email" class="form-control" id="signup-email" name="signup-email" required
               placeholder="Votre adresse e-mail">
    </div>
    <div class="form-group">
        <label for="signup-password">Mot de passe</label>
        <input type="password" class="form-control" id="signup-password" name="signup-password"
               required placeholder="Votre mot de passe">
    </div>
    <div class="form-group">
        <label for="signup-password-confirmation">Confirmation du mot de passe</label>
        <input type="password" class="form-control" id="signup-password-confirmation"
               name="signup-password-confirmation" required placeholder="Confirmez votre mot de passe">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
