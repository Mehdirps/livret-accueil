<div class="modal fade" id="updateProductModal_{{$product->id}}" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProductModalLabel">Ajouter un fond d'écran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.products.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
                    </div>
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="url">Lien du produit (sur maplaque-nfc.fr)</label>
                        <input class="form-control" type="url" name="url" id="url" placeholder="Url du produit" value="{{ $product->url }}" required>
                    </div>
                    @error('url')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <p>Image actuelle</p>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 100px;">
                        <br>
                        <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
