@extends('layouts.dashboard')

@section('dashboard_title', 'Mes suggestions')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Mes suggestions</h2>
        {{-- fait un formulaire de recherche avec le nom du client, le statut, le titre et le message --}}
        <form action="{{ route('dashboard.suggestion.search') }}" method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nom">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-3">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-3">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Titre">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-3">
                    <input type="text" name="message" id="message" class="form-control" placeholder="Message">
                </div>
                @error('message')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <select name="status" id="status" class="form-control">
                        <option value="all">Tout</option>
                        <option value="pending">En attente</option>
                        <option value="accepted">Accepté</option>
                        <option value="refused">Refusé</option>
                    </select>
                </div>
                @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>
        <hr>
        @if(!$livret->suggest)
            <div class="alert alert-warning" role="alert">
                Les suggestions ne sont pas activées sur votre livret
            </div>
            <a href="{{ route('dashboard.suggestion.enable', $livret->id) }}" class="text-white btn btn-success">Activer
                les suggestions</a>
        @else
            <div class="alert alert-success" role="alert">
                Les suggestions sont activées sur votre livret
            </div>
            <a href="{{ route('dashboard.suggestion.enable', $livret->id) }}" class="text-white btn btn-danger">Désactiver
                les suggestions</a>
        @endif
        <hr>
        <p>Exporter en PDF les suggestions affichées dans le tableau</p>
        <button id="exportPdf" class="btn btn-primary">Exporter en PDF</button>
        @if(count($livret->suggestions) > 0)
            <hr>
            <div class="row">
                <div class="col-4">
                    <div class="alert alert-success" role="alert">
                        Suggestions acceptées : {{ $livret->suggestions->where('status', 'accepted')->count() }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="alert alert-danger" role="alert">
                        Suggestions refusées : {{ $livret->suggestions->where('status', 'refused')->count() }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="alert alert-warning" role="alert">
                        Suggestions en attentes : {{ $livret->suggestions->where('status', 'pending')->count() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 btn btn-primary" id="all">
                    Tout
                </div>
                <div class="col-md-3 btn btn-success" id="accepted">
                    Acceptées
                </div>
                <div class="col-md-3 btn btn-danger" id="refused">
                    Refusées
                </div>
                <div class="col-md-3 btn btn-warning" id="pending">
                    En attente
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suggestions as $suggestion)
                        <tr data-status="{{ $suggestion->status }}" class="tr_data">
                            <td>{{ $suggestion->name }}</td>
                            <td>{{ $suggestion->email }}</td>
                            <td>{{ $suggestion->title }}</td>
                            <td>{{ $suggestion->message }}</td>
                            <td>
                                <form action="{{route('dashboard.suggestion.status')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <select name="status_suggest" id="status_suggest"
                                            class="form-control status_suggest">
                                        <option
                                            value="pending" {{ $suggestion->status == 'pending' ? 'selected' : '' }}>En
                                            attente
                                        </option>
                                        <option
                                            value="accepted" {{ $suggestion->status == 'accepted' ? 'selected' : '' }}>
                                            Accepté
                                        </option>
                                        <option
                                            value="refused" {{ $suggestion->status == 'refused' ? 'selected' : '' }}>
                                            Refusé
                                        </option>
                                    </select>
                                    @error('status_suggest')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="suggestion_id" value="{{ $suggestion->id }}">
                                </form>
                            </td>
                            {{--<td>
                                <a href="{{ route('dashboard.suggestion.delete', $suggestion->id) }}"
                                   class="btn btn-danger">Supprimer</a>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
@section('footer_script')
    <script>
        $('.status_suggest').change(function () {
            console.log('fagafga')
            $(this).parent().submit();
        });
        $('#accepted').click(function () {
            $('.tr_data').each(function () {
                if ($(this).data('status') === 'accepted') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        $('#refused').click(function () {
            $('.tr_data').each(function () {
                if ($(this).data('status') === 'refused') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        $('#pending').click(function () {
            $('.tr_data').each(function () {
                if ($(this).data('status') === 'pending') {
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
                    name: row.find('td:eq(0)').text(),
                    email: row.find('td:eq(1)').text(),
                    title: row.find('td:eq(2)').text(),
                    message: row.find('td:eq(3)').text(),
                    status: row.find('td:eq(4) select').val()
                });
            });

            $.ajax({
                url: '/dashboard/datas/export',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                    type: 'suggestions'
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    var link = document.createElement('a');
                    link.href = 'data:application/pdf;base64,' + response.pdf_base64;
                    link.download = 'suggestions.pdf';
                    link.click();
                }
            });
        });
    </script>
@endsection
