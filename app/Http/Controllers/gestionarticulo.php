<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulos;
use App\Models\Logarticulos;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\View;

//Excel-CSV Imports-Exports
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\articulosExport;

class gestionarticulo extends Controller
{
    public function getarticulos()
    {
        if (Auth::check()) {
            $articulos = Categorias::
                            join('articulos', 'categorias.id','=', 'articulos.categoria_id')
                            ->select('articulos.*','categoria_id', 'categorias.categoria')
                            ->get();

            return view('verarticulos', compact('articulos'));
        }else{
            return redirect()->back();
        }
    }

    public function getbusqueda(Request $request)
    {
        $articulos = Articulos::where('articulo','LIKE','%'.$request->busqueda.'%')
                                // ->orWhere('categoria', 'LIKE', '%'.$request->busqueda.'%')
                                ->get();

        // dd($articulos);

        $busqueda = $request->busqueda;

        // dd($busqueda);

        return view('busqueda',['busqueda' => $busqueda], compact('articulos'));
        // return view('busqueda', compact('articulos'));
    }

    public function getcategorias()
    {
        if (Auth::check()) {
            $categorias = Categorias::all();
            dd($categorias);
            return view('creaproducto')->with('categorias', $categorias);
        }else{
            return redirect()->back();
        }
    }

    public function generapdf(Request $request)
    {
        $categoria = Categorias::find($request->id);
        $articulos = Articulos::all()->where('categoria_id', $request->id);
        
        // $pdf = PDF::loadView('generapdf', $articulos);
        // return $pdf->download('categoria.pdf');

        // dd($categoria);
        $pdf = PDF::loadView('generapdf', compact('categoria'), compact('articulos'));
        $pdf -> setPaper('Letter');
        // return $pdf->download('categoría.pdf');
        return $pdf->stream('categoría.pdf');
    }

    public function getarticulo($id)
    {
        $articulos = Articulos::orderByRaw('RAND()')->take(4)->get();
        $articulo = Articulos::find($id);
        return view('producto', ['articulos' => $articulos])->with('articulo', $articulo);
    }

    public function guardararticulo(Request $request)
    {
        if (Auth::check()) {
            $newImageName = time() . '-' . $request->articulo . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            
            $articulo = new Articulos();
            $articulo->articulo = $request->articulo;
            $articulo->precio = $request->precio;
            $articulo->descripcion = $request->descripcion;
            $articulo->categoria_id = $request->categoria_id;
            $articulo->image_path = $newImageName;
            $articulo->save();

            $log = new Logarticulos();
            $log->idarticulo = $articulo->id;
            $log->articuloN = $articulo->articulo;
            $log->precioN = $articulo->precio;
            $log->descripcionN = $articulo->descripcion;
            $log->categoria_idN = $articulo->categoria_id;
            $log->image_pathN = $articulo->image_path;
            $log->save();
        }

        return redirect()->back();
    }

    public function eliminararticulo($id)
    {
        if (Auth::check()) {
            $articulo = Articulos::find($id);
            $articulo->forceDelete();
        }
        return redirect()->back();
    }

    public function muestraeditararticulo($id)
    {       
        if (Auth::check()) {
            $articulo = Articulos::find($id);
            $categorias = Categorias::all();   
            return view('editaproducto', ['categorias' => $categorias])->with('articulo', $articulo);
        }else{
            return redirect()->back();
        }
    }

    public function guardaredicionarticulo(Request $request)
    {
        if (Auth::check()) {
            $articulo = Articulos::find((int)$request->id);

            if ($request->image == NULL) {
                $newImageName = $articulo->image_path;
                $request->image_path = $newImageName;
            } else {
                $newImageName = time() . '-' . $request->articulo . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $newImageName);
            }

            $log = new Logarticulos();
            $log->idarticulo = $articulo->id;

            $log->articuloO = $articulo->articulo;
            $log->precioO = (int)$articulo->precio;
            $log->descripcionO = $articulo->descripcion;
            $log->categoria_idO = $articulo->categoria_id;
            $log->image_pathO = $articulo->image_path;

            $log->articuloN = $request->articulo;
            $log->precioN = (int)$request->precio;
            $log->descripcionN = $request->descripcion;
            $log->categoria_idN = $request->categoria_id;
            $log->image_pathN = $request->image_path;
            $log->save();

            $articulo->articulo = $request->articulo;
            $articulo->precio = (int)$request->precio;
            $articulo->descripcion = $request->descripcion;
            $articulo->categoria_id = $request->categoria_id;
            $articulo->image_path = $request->image_path;
            $articulo->save();

            // return redirect('');
            return redirect('/verarticulos');
        }else{
            return redirect()->back();
        }
    }

    public function exportart()
    {
        $export = Excel::download(new articulosExport, 'articulos.csv');
        return $export;
    }
}
