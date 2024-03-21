<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contactez le support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm" method="post" action="{{route('dashboard.contact')}}">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="subject" class="form-label">Sujet</label>
                        <select id="subject" name="subject" class="form-control">
                            <option disabled selected>-- Sélectionnez le type de demande --</option>
                            <option value="Soucis technique">Soucis technique</option>
                            <option value="Demande d'assistance">Demande d'assistance</option>
                            <option value="Demande de démonstration">Demande de démonstration</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rgpd" name="rgpd">
                        <label class="form-check" for="rgpd">J'accepte que mes données soient utilisées pour traiter ma
                            demande</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>
