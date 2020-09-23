<?php

namespace App\Http\Controllers;

use App\Gato;
use App\Http\Resources\Gato as GatoResource;
use App\Http\Resources\GatoCollection;
use Illuminate\Http\Request;

class GatoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return new GatoCollection(Gato::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'max:255'],
            'edad' => ['required', 'integer'],
            'imagen' => ['required'],
            'descripcion' => ['required', 'max:255']
        ]);

        $gato = new Gato();
        $gato->nombre = $request->nombre;
        $gato->edad = $request->edad;
        $gato->imagen = $request->imagen;
        $gato->descripcion = $request->descripcion;
        $gato->user_id = auth()->user()->id;
        $gato->save();

        return (new GatoResource($gato))->response()->setStatusCode(201);
    }

    public function show(Gato $gato)
    {
        return GatoResource(Gato::findOrFail($gato->id));
    }

    public function update(Request $request, Gato $gato)
    {
        $request->validate([
            'nombre' => ['required', 'max:255'],
            'edad' => ['required', 'integer'],
            'imagen' => ['required'],
            'descripcion' => ['required', 'max:255']
        ]);

        $gato->update($request->all());

        return new GatoResource($gato);
    }

    public function destroy(Gato $gato)
    {
        $gato->delete();

        return response()->json(null, 204);
    }
}
