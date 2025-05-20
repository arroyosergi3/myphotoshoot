<?php

namespace App\Http\Controllers;

use App\Models\Photoshoot;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoshootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photoshoots = Photoshoot::paginate(5);
        return view("photoshoot.index", compact("photoshoots"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("photoshoot.create");
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'img_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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


    // Crear el producto
    Photoshoot::create([
        'name' => $request->name,
        'photographer_id' => Auth::guard(name: 'photographer')->user()->id,
        'description' => $request->description,
        'img_url' => $imageUrl,
    ]);

    return redirect()->route('photoshoot.index')->with('success', 'Sesión creada correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Photoshoot $photoshoot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photoshoot $photoshoot)
    {
         $ps = $photoshoot;
         return view('photoshoot.edit', compact('ps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photoshoot $photoshoot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photoshoot $photoshoot)
    {
        //
    }
}
