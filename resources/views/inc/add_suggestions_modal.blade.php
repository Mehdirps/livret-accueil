<div class="modal fade" id="suggestionModal" tabindex="-1" aria-labelledby="suggestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suggestionModalLabel">Envoyé une suggestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suggestion.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Votre nom</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Votre e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{old('title')}}">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" required>{{old('message')}}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rgpd" name="rgpd" required>
                        <label class="form-check" for="rgpd">J'accepte que mes données soient utilisées pour traiter ma
                            demande</label>
                    </div>
                    <input type="hidden" name="livret_id" value="{{ $livret->id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
