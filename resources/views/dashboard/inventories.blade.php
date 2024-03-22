@extends('layouts.dashboard')

@section('dashboard_title', 'Statistiques')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Etats de lieux</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
            Ajouter un état des lieux
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
                        <tr>
                            <td>{{ $inventory->client_name }}</td>
                            <td>{{ $inventory->start_date }}</td>
                            <td>{{ $inventory->end_date }}</td>
                            <td>{{ $inventory->client_comment }}</td>
                            <td>
                                <form action="{{route('dashboard.inventories.status')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <select name="status" id="status" class="form-control">
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
        $('#status').change(function () {
            $(this).parent().submit();
        });
    </script>
@endsection
