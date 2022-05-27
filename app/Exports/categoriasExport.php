<?php

namespace App\Exports;

use App\Models\categorias;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class categoriasExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["id", "Categoria"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return categorias::select('id', 'categoria')->get();
    }
}
