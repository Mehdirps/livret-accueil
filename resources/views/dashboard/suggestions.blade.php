@extends('layouts.dashboard')

@section('dashboard_title', 'Statistiques')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Mes suggestions</h2>
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
        @if(count($livret->suggestions) > 0)
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
                    @foreach($livret->suggestions as $suggestion)
                        <tr>
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
    </script>
@endsection
