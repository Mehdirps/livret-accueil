@extends('layouts.dashboard')

@section('dashboard_title', 'Statistiques')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Etats de lieux</h2>
        {{-- Fait un formilaire de recherche --}}
        <form action="{{ route('dashboard.inventories.search') }}" method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="client_name" class="form-control" placeholder="Nom du client">
                </div>
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Date d'arrivée">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="Date de départ">
                </div>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control">
                        <option value="">Status</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>
        <hr>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
            Ajouter un état des lieux
        </button>
        <hr>
        <p>Exporter en PDF les états des lieux affichées dans le tableau</p>
        <button type="button" class="btn btn-secondary" id="exportPdf">
            Exporter en PDF
        </button>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-3 btn btn-primary" id="all">
                Tout
            </div>
            <div class="col-md-3 btn btn-success" id="completed">
                Terminées
            </div>
            <div class="col-md-3 btn btn-danger" id="in_progress">
                En cours
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom du client</th>
                    <th>Date d'arrivée</th>
                    <th>Date de départ</th>
                    <th>Commentaire du client</th>
                    <th>Status</th>
                    <th>Pièces jointes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($inventories) > 0)
                    @foreach($inventories as $inventory)
                        <tr data-status="{{$inventory->status}}" class="tr_data">
                            <td>{{ $inventory->client_name }}</td>
                            <td>{{ $inventory->start_date }}</td>
                            <td>{{ $inventory->end_date }}</td>
                            <td>{{ $inventory->client_comment }}</td>
                            <td>
                                <form action="{{route('dashboard.inventories.status')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <select name="status" id="status" class="form-control status">
                                        <option
                                            value="in_progress" {{ $inventory->status == 'in_progress' ? 'selected' : '' }}>
                                            En cours
                                        </option>
                                        <option
                                            value="completed" {{ $inventory->status == 'completed' ? 'selected' : '' }}>
                                            Terminé
                                        </option>
                                    </select>
                                    <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                </form>
                            </td>
                            <td>
                                @if($inventory->attachment_names)
                                    @if(count(json_decode($inventory->attachment_names)) > 0)
                                        @foreach(json_decode($inventory->attachment_names) as $attachment)
                                            <a href="{{ asset($attachment) }}" target="_blank">
                                                {{ str_replace('assets/uploads/inventory_attachments/', '', $attachment) }}
                                            </a>
                                            <br>
                                        @endforeach
                                    @else
                                        Aucune pièce jointe
                                    @endif
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('dashboard.inventories.delete', $inventory->id) }}"
                                      method="post"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet état des lieux ?')">
                                        Supprimer
                                    </button>
                                </form>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Aucun état des lieux trouvé</td>
                    </tr>
                @endif
                </tbody>
            </table>
            @include('inc.pagination', ['paginator' => $inventories])
        </div>
    </div>
    @include('dashboard.partials.add_inventory_modal')
@endsection
@section('footer_script')
    <script>
        $('.status').change(function () {
            $(this).parent().submit();
        });
        $('#completed').click(function () {
            $('.tr_data').each(function () {
                if ($(this).data('status') === 'completed') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        $('#in_progress').click(function () {
            $('.tr_data').each(function () {
                if ($(this).data('status') === 'in_progress') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        $('#all').click(function () {
            $('.tr_data').each(function () {
                $(this).show();
            });
        });

        $('#exportPdf').on('click', function() {
            var data = [];
            $('table tbody tr:visible').each(function() {
                var row = $(this);
                data.push({
                    client_name: row.find('td:eq(0)').text(),
                    start_date: row.find('td:eq(1)').text(),
                    end_date: row.find('td:eq(2)').text(),
                    client_comment: row.find('td:eq(3)').text(),
                    status: row.find('td:eq(4) select').val(),
                    attachments: row.find('td:eq(5) a').map(function() {
                        return $(this).attr('href');
                    }).get()
                });
            });

            $.ajax({
                url: '/dashboard/datas/export',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                    type: 'inventories'
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    var link = document.createElement('a');
                    link.href = 'data:application/pdf;base64,' + response.pdf_base64;
                    link.download = 'inventories.pdf';
                    link.click();
                }
            });
        });
    </script>
@endsection
