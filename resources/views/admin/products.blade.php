@extends('layouts.admin')

@section('admin_title', 'Les produits')

@section('admin_content')
    <h1>Les produits</h1>
    <hr>
    <h2>Ajouter un produit</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="url">Description</label>
            <input class="form-control" type="url" name="url" id="url" placeholder="Url du produit" required>
        </div>
        <div class="form-group">
            <label for="description">Image</label>
            <input class="form-control" type="file" name="image" id="image" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <hr>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Url</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(count($products) > 0)
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 style="width: 100px;"></td>
                        <td>{{ $product->url }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                             <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                   style="display: inline;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Supprimer</button>
                             </form>--}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Aucun produit</td>
                </tr>
            @endif
            </tbody>
        </table>
        @include('inc.pagination', ['paginator' => $products])
    </div>
@endsection
