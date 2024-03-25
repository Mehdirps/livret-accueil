<div class="modal fade" id="updateModal_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Mise à jour du profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-form" action="{{route('dashboard.profile.update_user')}}" method="post"
                      class="p-5 bg-light rounded" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
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
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                   placeholder="Votre nom" value="{{ $user->name}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   placeholder="Votre adresse e-mail" value="{{$user->email}}">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Votre numéro de téléphone" value="{{$user->phone}}">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="birth_date">Date de naissance</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date"
                                   value="{{$user->birth_date}}">
                            @error('birth_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Votre adresse" value="{{$user->address}}">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            @if($user->avatar)
                                <p>Avatar actuel</p>
                                <figure style="border-radius: 50%; overflow: hidden;width: 100px">
                                    <img src="{{asset($user->avatar)}}" alt="avatar" class="img-thumbnail"
                                         style="width: 100px;object-fit: cover">
                                </figure>
                            @endif
                            <label for="avatar">Changer mon Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" aria-describedby="avatarHelp">
                            <small id="avatarHelp" class="form-text text-muted">Seuls les fichiers PNG, JPG, JPEG et WEBP sont
                                autorisés</small>
                            @error('avatar')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="admin_update" value="{{$user->id}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>
