<div class="modal fade" id="endInfosModal" tabindex="-1" aria-labelledby="endInfosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="endInfosModalLabel">Infos de départ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous trouverez ici toutes les informations concernant le départ de notre établissement</p>
                @if(!$livret->endInfos->isEmpty())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Infos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livret->endInfos as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->text}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
