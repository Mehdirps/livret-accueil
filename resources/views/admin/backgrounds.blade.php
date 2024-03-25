@extends('layouts.admin')

@section('admin_title', 'Liste des fonds d\'écran')

@section('admin_content')
    <h1>Listes des fonds d'écran</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupModal">
        Ajouter un groupe de fond d'écran
    </button>
    @include('admin.partials.add_background_group_modal')
    <hr>
    <div class="row">
        @foreach($background_group as $group)
            <div class="col-md-2">
                <div class="card">
                    <div class="btn btn-primary btn_group" data-id="{{$group->id}}">{{$group->name}}</div>
                    <form action="{{route('admin.background_groups.delete', $group->id)}}" method="get">
                        @csrf
                        @method('get')
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
        @foreach($background_group as $group)
            <div class="col-md-12 backgroup_card_group" data-group_id="{{$group->id}}">
                <h2>{{$group->name}}</h2>
                <p>{{$group->description}}</p>
                <div class="container">
                    @foreach($group->backgrounds->chunk(3) as $chunk)
                        <div class="row">
                            @foreach($chunk as $background)
                                    <div class="card col-md-4 backgroup_card">
                                        <a href="{{route('dashboard.background.update',$background->id)}}">
                                            <img src="{{asset($background->path)}}" alt="{{$background->name}}"
                                                 class="img-fluid w-100 h-100">
                                        </a>
                                    </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('admin_script')
    <script>
        $(document).ready(function () {
            $('.backgroup_card_group').hide();
            $('.btn_group').click(function () {
                let group_id = $(this).data('id');
                $('.backgroup_card_group').hide();
                $('div[data-group_id="' + group_id + '"]').show();
            });
        });
    </script>
@endsection
