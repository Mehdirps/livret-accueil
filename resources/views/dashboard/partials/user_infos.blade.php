<div class="col-12">
    <h2><i class="bi bi-info-circle"></i> Vos informations</h2>
    <form id="update-form" action="{{route('dashboard.profile.update_user')}}" method="post"
          class="p-5 bg-light rounded" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="row">
            <div class="form-group col-md-4">
                <label for="civility">Civilité</label>
                <select class="form-control" name="civility" id="civility">
                    <option selected disabled>-- Choisir --</option>
                    <option value="M." @if($user->civility == 'M.') selected @endif>M.</option>
                    <option value="Mme" @if($user->civility == 'Mme') selected @endif>Mme</option>
                </select>
                @error('civility')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required
                       placeholder="Votre nom" value="{{ $user->name}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="email">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" required
                       placeholder="Votre adresse e-mail" value="{{$user->email}}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="phone">Téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       placeholder="Votre numéro de téléphone" value="{{$user->phone}}">
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="birth_date">Date de naissance</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date"
                       value="{{$user->birth_date}}">
                @error('birth_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" id="address" name="address"
                       placeholder="Votre adresse" value="{{$user->address}}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                @if($user->avatar)
                    <p>Avatar actuel</p>
                    <figure style="border-radius: 50%; overflow: hidden;width: 100px">
                        <img src="{{asset($user->avatar)}}" alt="avatar" class="img-thumbnail"
                             style="width: 100px;object-fit: cover">
                    </figure>
                @endif
                <label for="avatar">Changer mon Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    <br>
    <form id="update-form" action="{{route('dashboard.profile.update_password')}}" method="post"
          class="p-5 bg-light rounded">
        @csrf
        @method('post')
        <h3><i class="bi bi-key"></i> Changer mon mot de passe</h3>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="old_password">Mot de passe actuel</label>
                <input type="password" class="form-control" id="old_password" name="old_password"
                       placeholder="Votre mot de passe actuel" required>
                @error('old_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Votre nouveau mot de passe" required>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirmation nouveau mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       placeholder="Confirmez votre nouveau mot de passe" required>
                @error('confirmed_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>
    </form>
</div>
