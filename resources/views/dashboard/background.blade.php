@extends('layouts.dashboard')
@section('dashboard_title', 'Changement de fond')

@section('dashboard_content')
    <h1>Changer le fond de votre livret</h1>
    <div class="row">
        <div class="col-md-4">
                <p>Fond actuel</p>
                <img src="{{asset($livret->background)}}" alt="Fond actuel" class="img-fluid">
        </div>
    </div>
    <p>Cliquez sur le fond que vous souhaitez pour le changer</p>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="row">
        @foreach($background_group as $group)
            <div class="col-md-2">
                <div class="card">
                    <div class="btn btn-primary btn_group" data-id="{{$group->id}}">{{$group->name}}</div>
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
                                @if($livret->background !== $background->path)
                                    <div class="card col-md-4 backgroup_card">
                                        <a href="{{route('dashboard.background.update',$background->id)}}">
                                            <img src="{{asset($background->path)}}" alt="{{$background->name}}"
                                                 class="img-fluid w-100 h-100">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer_script')
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
