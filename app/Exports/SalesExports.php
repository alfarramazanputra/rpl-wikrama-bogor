<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('sales as s')
            ->join('sale_details as d', 's.id', '=', 'd.sale_id')
            ->join('products as p', 'p.id', '=', 'd.product_id')
            ->leftJoin('members as m', 'm.id', '=', 's.member_id')
            ->select(
                's.date',
                'm.name as member_name',
                'm.phone_number as member_phone',
                'm.member_point',
                'm.date as member_date',
                DB::raw("GROUP_CONCAT(CONCAT(p.name, ' ( ', d.product_qty, ' : Rp. ', d.product_price, ' ) ') SEPARATOR ' , ') as product_details"),
                's.total',
                's.amount_paid',
                's.point_used',
                's.change'
            )
            ->groupBy('s.id', 's.date', 'm.name', 'm.phone_number', 'm.member_point', 'm.date', 's.total', 's.amount_paid', 's.point_used', 's.change')
            ->orderBy('s.date', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Pembelian', 'Nama Pelanggan', 'No HP Pelanggan', 'Poin Pelanggan', 'Tanggal Bergabung', 'Nama Produk', 
            'Total', 'Tunai', 'Poin Digunakan', 'Kembalian',
        ];
    }

}