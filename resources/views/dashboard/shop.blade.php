@extends('layouts.dashboard')

@section('dashboard_title', 'Notre boutique')

@section('dashboard_content')
    <div class="col-md-9 col-12">
        <h1>Notre boutique</h1>
        <p>Vous pouvez acheter des objets pour votre livret d'accueil.</p>
        {{--<form action="{{route('dashboard.products.search')}}" method="get">
            @csrf
            @method('get')
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Rechercher un produit"
                       value="{{request('search')}}">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>--}}
        <div class="row">
            @foreach($categories as $category)
                @if(count($category->products) > 0)
                <div class="col-12">
                    <h2>{{$category->name}}</h2>
                    {{-- Fait la description avec nl2br--}}
                    <p>{!! nl2br(e($category->description)) !!}</p>
                    <div class="row">
                        @foreach($category->products as $product)
                            <div class="col-md-4 col-6">
                                <div class="card h-100">
                                    <img src="{{asset($product->image)}}" class="card-img-top"
                                         alt="{{$product->name}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->name}}</h5>
                                        <p class="card-text">{{$product->description}}</p>
                                        <p class="card-text">{{$product->price}} €</p>
                                        <a href="{{$product->url}}" class="btn btn-primary" target="_blank">Voir</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
