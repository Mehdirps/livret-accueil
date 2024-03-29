<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\BackgroundGroup;
use App\Models\Livret;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Psy\Util\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users = User::where('role', 'user')->paginate(15);

        return view('admin.users', [
            'users' => $users
        ]);

    }

    public function enableUser($id)
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();

        return redirect()->back()->with('success', $user->active ? 'Utilisateur activé' : 'Utilisateur désactivé');
    }

    public function searchUsers(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('role', 'user')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            })
            ->paginate(15);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function backgrounds()
    {
        $background_group = BackgroundGroup::all();

        return view('admin.backgrounds', [
            'background_group' => $background_group
        ]);
    }

    public function addBackgroundGroup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $background = new BackgroundGroup();
        $background->name = $request->name;
        $background->description = $request->description;

        $background->save();

        $directoryName = str_replace(' ', '_', strtolower($request->name));
        $directoryPath = public_path('assets/backgrounds/' . $directoryName);

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        return redirect()->back()->with('success', 'Background ajouté');
    }

    public function deleteBackgroundGroup($id)
    {
        $backgroundGroup = BackgroundGroup::find($id);

        foreach ($backgroundGroup->backgrounds as $background) {
            $file_path = public_path($background->path);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $background->delete();
        }

        $backgroundGroup->delete();

        return redirect()->back()->with('success', 'Background supprimé');
    }

    public function addBackground(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'background_group_id' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $backgroundGroup = BackgroundGroup::find($request->background_group_id);

        $background = $request->file('file');
        $backgroundName = time() . '.' . $background->extension();
        $background->move(public_path('assets/backgrounds/' . str_replace(' ', '_', strtolower($backgroundGroup->name))), $backgroundName);

        $background = new Background();
        $background->name = $request->name;
        $background->path = 'assets/backgrounds/' . str_replace(' ', '_', strtolower($backgroundGroup->name)) . '/' . $backgroundName;
        $background->backgrounds_group_id = $request->background_group_id;
        $background->save();

        return redirect()->back()->with('success', 'Fond d\'écran ajouté');
    }

    public function deleteBackground($id)
    {
        $background = Background::find($id);
        $file_path = public_path($background->path);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $background->delete();

        return redirect()->back()->with('success', 'Fond d\'écran supprimé');
    }

    public function livrets()
    {
        $livrets = Livret::paginate(15);

        return view('admin.livrets', [
            'livrets' => $livrets
        ]);
    }

    public function searchLivrets(Request $request)
    {
        $search = $request->get('search');

        $livrets = Livret::where('livret_name', 'like', '%' . $search . '%')
            ->orWhere('establishment_name', 'like', '%' . $search . '%')
            ->orWhere('establishment_address', 'like', '%' . $search . '%')
            ->orWhere('establishment_phone', 'like', '%' . $search . '%')
            ->paginate(15);

        return view('admin.livrets', [
            'livrets' => $livrets
        ]);
    }

    public function products()
    {
        $products = Product::paginate(15);
        $categories = ProductCategory::all();

        return view('admin.products', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'url' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'category' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->url = $request->url;
        $product->price = $request->price;
        $product->category_id = $request->category;

        $productImage = $request->file('image');
        $productImageName = time() . '.' . $productImage->extension();
        $productImage->move(public_path('assets/uploads/products'), $productImageName);

        $product->image = 'assets/uploads/products/' . $productImageName;
        $product->save();

        return redirect()->back()->with('success', 'Produit ajouté');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        $file_path = public_path($product->image);

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Produit supprimé');
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'url' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp',
            'category' => 'required',
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->url = $request->url;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $file_path = public_path($product->image);
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $productImage = $request->file('image');
            $productImageName = time() . '.' . $productImage->extension();
            $productImage->move(public_path('assets/uploads/products'), $productImageName);

            $product->image = 'assets/uploads/products/' . $productImageName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Produit modifié');
    }

    public function searchProducts(Request $request)
    {
        $search = $request->search;

        $products = Product::where('name', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('url', 'like', '%' . $search . '%')
            ->paginate(1);

        return view('admin.products', [
            'products' => $products
        ]);
    }

    public function addProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $productCategory = new ProductCategory();
        $productCategory->name = $request->name;
        $productCategory->slug = \Illuminate\Support\Str::slug($request->name);
        $productCategory->description = $request->description;
        $productCategory->save();

        return redirect()->back()->with('success', 'Catégorie de produit ajoutée');
    }

    public function deleteProductCategory($id)
    {
        $productCategory = ProductCategory::find($id);

        if ($productCategory->products->count() > 0) {
            foreach ($productCategory->products as $product) {
                $file_path = public_path($product->image);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $product->delete();
            }
        }

        $productCategory->delete();

        return redirect()->back()->with('success', 'Catégorie de produit supprimée');
    }

    public function updateProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'id' => 'required',
        ]);

        $productCategory = ProductCategory::find($request->id);
        $productCategory->name = $request->name;
        $productCategory->slug = \Illuminate\Support\Str::slug($request->name);
        $productCategory->description = $request->description;
        $productCategory->save();

        return redirect()->back()->with('success', 'Catégorie de produit modifiée');
    }
}
