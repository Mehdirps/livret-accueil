<div class="modal fade" id="startInfosModal" tabindex="-1" aria-labelledby="startInfosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startInfosModalLabel">Infos d'arrivée</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous trouverez ici toutes les informations concernant votre arrivée dans notre établissement</p>
                @if(!$livret->startInfos->isEmpty())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Infos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($livret->startInfos as $item)
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
