@extends('layouts.dashboard')

@section('dashboard_title', 'Mon profil')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center">
                        @if($user->avatar)
                            <figure style="border-radius: 50%; overflow: hidden;width: 100px; margin: auto;">
                                <img src="{{asset($user->avatar)}}" alt="avatar" class="img-thumbnail"
                                     style="width: 100px;object-fit: cover">
                            </figure>
                        @endif
                        <h1 >{{$user->name}}</h1    >
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
            @include('dashboard.partials.user_infos')
            @include('dashboard.partials.livret_infos')
        </div>
    </div>
@endsection
