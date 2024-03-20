<div class="modal fade" id="utilsInfosModal" tabindex="-1" aria-labelledby="utilsInfosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="utilsInfosModalLabel">Infos d'arrivée</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous trouverez ici toutes les informations dont vous pouvez avoir besoin</p>
                @if(!$livret->utilsInfos->isEmpty())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Infos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livret->utilsInfos as $item)
                            <tr>
                                <td>{{$item->sub_name}}</td>
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
