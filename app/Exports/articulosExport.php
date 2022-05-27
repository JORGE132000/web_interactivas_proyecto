<?php

namespace App\Exports;

use App\Models\articulos;
use App\Models\categorias;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class articulosExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        // return ["id", "Articulo", "Categoria_ID", "Precio", "Descripcion"];
        return ["id", "Articulo", "Categoria", "Precio", "Descripcion"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $articulos = Categorias::
        //     join('articulos', 'categorias.id','=', 'articulos.categoria_id')
        //     ->select('articulos.*','categoria_id', 'categorias.categoria')
        //     ->get();

        $articulos = Categorias::
            join('articulos', 'categorias.id','=', 'articulos.categoria_id')
            ->select('articulos.id', 'articulos.articulo','categorias.categoria','articulos.precio', 'articulos.precio', 'articulos.descripcion')
            ->get();

        // return articulos::select('id', 'articulo', 'categoria_id', 'precio', 'descripcion')->get();
        return $articulos;
    }
}
