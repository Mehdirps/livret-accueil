<div class="modal fade" id="utilsPhoneModal" tabindex="-1" aria-labelledby="utilsPhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="utilsPhoneModalLabel">Numéros utiles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous trouverez ici toutes les numéros dont vous pouvez avoir besoin</p>
                @if(!$livret->utilsPhone->isEmpty())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Police</td>
                            <td><a href="tel:17">17</a></td>
                        </tr>
                        <tr>
                            <td>Pompiers</td>
                            <td><a href="tel:18">18</a></td>
                        </tr>
                        <tr>
                            <td>Samu</td>
                            <td><a href="tel:15">15</a></td>
                        </tr>
                        <tr>
                            <td>Urgences</td>
                            <td><a href="tel:112">112</a></td>
                        </tr>
                        @foreach($livret->utilsPhone as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td><a href="tel:{{$item->number}}">{{$item->number}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
