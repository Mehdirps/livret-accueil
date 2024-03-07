<div class="col-12">
    <h2><i class="bi bi-info-circle"></i> Vos informations</h2>
    <form id="update-form" action="{{route('dashboard.profile')}}" method="post">
        @csrf
        @method('post')
        <div class="row">
            <div class="form-group col-md-4">
                <label for="civility">Civilité</label>
                <select class="form-control" name="civility" id="civility">
                    <option selected disabled>-- Choisir --</option>
                    <option value="M." @if($user->civility) selected @endif>M.</option>
                    <option value="Mme" @if($user->civility) selected @endif>Mme</option>
                </select>
                @error('civility')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="last_name">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required
                       placeholder="Votre nom" value="{{ $user->name}}">
                @error('last_name')
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
        <br>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
