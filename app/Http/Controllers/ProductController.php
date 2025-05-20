<?php

namespace App\Http\Controllers;

use App\Models\Product;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // 1. Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'img_url' => 'required|image|mimes:jpeg,png,jpg,gif', 
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

     // 2. Procesar y guardar la imagen directamente en public/images/products
    if ($request->hasFile('img_url')) {
        $image = $request->file('img_url');
        $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images/products'); // Ruta a la carpeta public/images/products
        $image->move($destinationPath, $filename);
        $imageUrl = '/images/products/' . $filename; // Ruta para guardar en la base de datos (relativa a public)
    } else {
        $imageUrl = null;
    }

    // 3. Crear un nuevo producto en la base de datos
    Product::create([
        'name' => $request->name,
        'photographer_id' => Auth::guard( 'photographer')->user()->id,
        'img_url' => $imageUrl,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    // 4. Redireccionar al usuario con un mensaje de éxito
    return redirect()->route('product.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $p = $product;
         return view('products.edit', compact('p'));

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    // 1. Buscar el producto
    $product = Product::findOrFail($id);

    // 2. Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif', // No requerida
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

    // 3. Procesar la imagen si se ha subido una nueva
    if ($request->hasFile('img_url')) {
        // Eliminar la imagen anterior si existe
        if ($product->img_url && file_exists(public_path($product->img_url))) {
            unlink(public_path($product->img_url));
        }

        $image = $request->file('img_url');
        $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images/products');
        $image->move($destinationPath, $filename);
        $imageUrl = '/images/products/' . $filename;
    } else {
        $imageUrl = $product->img_url; // Mantener la imagen actual si no se sube una nueva
    }

    // 4. Actualizar los datos del producto
    $product->update([
        'name' => $request->name,
        'img_url' => $imageUrl,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    // 5. Redireccionar con mensaje de éxito
    return redirect()->route('product.index')->with('success', 'Producto actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        $product->delete();
        return redirect()->route('product.index')->with( 'success', 'Producto eliminado correctamente.');
  
    }
}
