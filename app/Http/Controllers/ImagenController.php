<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
      $imagen = $request->file('file');

      $nombreImagen   = Str::uuid() . "." . $imagen->extension();
      $imagenServidor = Image::make($imagen);

      $imagenServidor->fit(1000,1000); // Para recortar la imagen Cosas que puedo hacer con la libreria https://image.intervention.io/v2/introduction/installation
      
      $imagenPath = public_path('uploads') . '/' . $nombreImagen;
      $imagenServidor->save($imagenPath);

      return response()->json(['imagen' => $nombreImagen ]);
    }
}
