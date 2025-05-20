<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @disregard */
        $packs = Auth::guard('photographer')->user()->packs()->paginate(4);
        return view('pack.index',  compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @disregard */
         $photoshoots = Auth::guard('photographer')->user()->photoshoots()->paginate(4);
        return view('pack.create', compact('photoshoots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'photoshoot' => 'nullable|exists:photoshoots,id',
        'price' => 'required|numeric|min:0',
        'img_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    
     // 2. Procesar y guardar la imagen directamente en public/images/products
    if ($request->hasFile('img_url')) {
        $image = $request->file('img_url');
        $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images/packs'); // Ruta a la carpeta public/images/products
        $image->move($destinationPath, $filename);
        $imageUrl = '/images/packs/' . $filename; // Ruta para guardar en la base de datos (relativa a public)
    } else {
        $imageUrl = null;
    }

    // Crear pack
     Pack::create([
        'name' => $request->name,
        'description' => $request->description,
        'photographer_id' => Auth::guard('photographer')->user()->id,
        'photoshoot_id' => $request->photoshoot,
        'price' => $request->price,
        'img_url' => $imageUrl,
    ]);


    return redirect()->route('pack.index')->with('success', 'Pack creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Pack $pack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pack $pack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pack $pack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack)
    {
        //
    }
}
