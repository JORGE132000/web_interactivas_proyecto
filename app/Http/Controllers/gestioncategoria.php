<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulos;

use App\Models\Categorias;
use App\Models\Logcategorias;

//Excel-CSV Imports-Exports
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\categoriasImport;
use App\Exports\categoriasExport;

class gestioncategoria extends Controller
{
    public function getcategorias(){

        if (Auth::check()) {
            // The user is logged in...
            $categorias = Categorias::all();
            $articulos = Articulos::all();
            
            // return view('administracategorias')->with('categorias', $categorias);
            return view('administracategorias', compact('categorias'), compact('articulos'));
        }else{
            return redirect()->back();
        }
    }

    public function getcategoriaswelcome(){
        // $articulos = Articulos::all();
        // $articulos = Articulos::inRandomOrder()->limit(8)->get();
        // $artslider = Articulos::orderByRaw('RAND()')->take(3)->get();
        $articulos = Articulos::orderByRaw('RAND()')->take(8)->get();
        $categorias = Categorias::all();
        // dd($articulos);
        // dd($categorias);
        return view('/welcome', ['articulos' => $articulos])->with('categorias', $categorias);
    }

    public function getcategoria(Request $request){
        $categoria = Categorias::find($request->id);

        $articulos = Articulos::all()->where('categoria_id', $request->id);
        return view('categoria', ['articulos' => $articulos])->with('categoria', $categoria);
    }

    public function guardarcategoria(Request $request)
    {
        if (Auth::check()){
            if($request->categoria == NULL){
                return redirect()->back();
            }
    
            $categoria = new Categorias();
            $categoria->categoria=$request->categoria;
            $categoria->save();
    
            $log = new logcategorias();
            $log->idcategoria=$categoria->id;
            $log->categoriaN=$categoria->categoria;
            $log->save();
        }

        return redirect()->back();
    }

    public function eliminacategoria($id) {
        if (Auth::check()){
            $categoria = Categorias::find($id);
            $categoria->forceDelete();
        }

        return redirect()->back();
    }

    public function guardaredicion(Request $request)
    {
        if (Auth::check()){
            $categoria = Categorias::find($request->id);

            $log=new Logcategorias();
            
            $log->idcategoria=$categoria->id;
            $log->categoriaO=$categoria->categoria;

            $log->categoriaN=$request->categoria;

            $categoria->categoria=$request->categoria;
            $categoria->save();

            $log->save();
        }

        return redirect()->back();
    }

    public function importcat()
    {
        Excel::import(new categoriasImport, request()->file('file'));
        return redirect()->back()->with('success','Data Imported Successfully');
    }

    public function exportcat()
    {
        $export = Excel::download(new categoriasExport, 'categorias.csv');
        return $export;
    }
}
