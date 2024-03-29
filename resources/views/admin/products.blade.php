@extends('layouts.admin')

@section('admin_title', 'Les produits')

@section('admin_content')
    <h1>Boutique</h1>
    <hr>
    <form action="{{ route('admin.products.searchProducts') }}" method="post">
        @csrf
        @method('post')
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher un produit" name="search" required>
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </div>
    </form>
    <br>
    <h2>Ajouter une catégorie</h2>
    <form action="{{route('admin.product_categories.add')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <hr>
    <h3>Listes des catégories</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                     data-bs-target="#updateCategoryModal_{{$category->id}}"><i class="bi bi-pencil"></i>
                             </button>
                             <form action="{{ route('admin.product_categories.delete', $category->id) }}" method="get"
                                   style="display: inline;">
                                 @csrf
                                 @method('get')
                                 <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                             </form>--}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Aucune catégorie</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <h2>Ajouter un produit</h2>
    <form action="{{route('admin.products.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="url">Lien du produit (sur maplaque-nfc.fr)</label>
            <input class="form-control" type="url" name="url" id="url" placeholder="Url du produit" required>
        </div>
        @error('url')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" name="image" id="image" required>
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select class="form-control" name="category" id="category" required>
                <option selected disabled>Choisir une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <hr>
    <h3>Listes des produits</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Url</th>
                <th>Catégorie</th>
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
                        <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                 style="width: 100px;"></td>
                        <td>{{ $product->url }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateProductModal_{{$product->id}}"><i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="get"
                                  style="display: inline;">
                                @csrf
                                @method('get')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
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
        @foreach($products as $product)
            @include('admin.partials.update_product_modal')
        @endforeach
    </div>
@endsection
