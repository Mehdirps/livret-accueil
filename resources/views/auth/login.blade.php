<form id="login-form" class="d-none" action="{{route('home.login')}}" method="post">
    @csrf
    @method('POST')
    <h2>Connexion</h2>
    <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" class="form-control" id="email" name="email" required
               placeholder="Votre adresse e-mail">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required
               placeholder="Votre mot de passe">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
