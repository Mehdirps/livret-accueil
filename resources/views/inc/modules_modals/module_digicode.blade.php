<div class="modal fade" id="digicodeModal" tabindex="-1" aria-labelledby="digicodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="digicodeModalLabel">Digicode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici les digicodes dont vous aurez besoin pendant votre séjour !</p>
                @if(!$livret->digicode->isEmpty())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livret->digicode as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->code}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
