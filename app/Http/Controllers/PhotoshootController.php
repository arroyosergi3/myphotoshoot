<?php

namespace App\Http\Controllers;

use App\Models\Photographer;
use App\Models\Photoshoot;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PhotoshootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @disregard */
        $photoshoots = Auth::guard("photographer")->user()->photoshoots()->paginate(5);
        return view("photoshoot.index", compact("photoshoots"));
    }
    public function clientIndex(Photographer $photographer)
    {
        $photoshoots = $photographer->photoshoots; // Asumiendo que tenés la relación definida
        session()->put('photographer', $photographer->id);
        return view('clients.photoshootsIndex', compact('photoshoots', 'photographer'));
    }

    public function clientPhotoshootIndex(Photographer $photographer, Photoshoot $photoshoot)
    {
        if ($photoshoot->photographer_id !== $photographer->id) {
            return back()->with('error', 'No tienes acceso a esta sesión.');
        }
        session()->put('duration', $photoshoot->duration);
        $packs = $photoshoot->packs;
        
        return view('clients.photoshootsPakcsIndex', compact('packs'));
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
            'duration' => 'required',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // 2. Procesar y guardar la imagen directamente en public/images/products
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/photoshoots'); // Ruta a la carpeta public/images/products
            $image->move($destinationPath, $filename);
            $imageUrl = '/images/photoshoots/' . $filename; // Ruta para guardar en la base de datos (relativa a public)
        } else {
            $imageUrl = null;
        }


        // Crear el producto
       
        Photoshoot::create([
            'name' => $request->name,
            'duration' => $request->duration,
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
        if ($photoshoot->photographer_id != Auth::guard(name: 'photographer')->user()->id) {
            return redirect()->route('photoshoot.index')->with('error', 'No tienes permisos para eso');
        } else {
            $ps = $photoshoot;
            return view('photoshoot.edit', compact('ps'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photoshoot $photoshoot)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageUrl = $photoshoot->img_url;

        if ($request->hasFile('img_url')) {
            // Eliminar imagen anterior si existe
            if ($imageUrl && File::exists(public_path($imageUrl))) {
                File::delete(public_path($imageUrl));
            }

            // Guardar nueva imagen
            $image = $request->file('img_url');
            $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/products');
            $image->move($destinationPath, $filename);
            $imageUrl = '/images/products/' . $filename;
        }

        $photoshoot->update([
            'name' => $request->name,
            'description' => $request->description,
            'img_url' => $imageUrl,
        ]);

        return redirect()->route('photoshoot.index')->with('success', 'Sesión actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photoshoot $photoshoot)
    {
        $photoshoot->delete();
        return redirect()->route('photoshoot.index')->with('success', 'Sesion eliminado correctamente.');
    }
}
