<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('products')
            ->select('id', 'name', 'price', 'stock')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Stock',
        ];
    }
}
