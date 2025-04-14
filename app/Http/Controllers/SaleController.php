<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Member;
use App\Models\SaleDetail;
use App\Exports\SalesExports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Sale::with('member')
            ->when($request->keyword, function ($query, $keyword) {
                return $query->whereHas('member', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->simplePaginate(10);

        return view('pages.sales.index', compact('data'));
    }

    public function productSale()
    {
        $data = Product::all();
        return view('pages.sales.products', compact('data'));
    }

    public function checkout(Request $request)
    {
        $cart = json_decode($request->cart_checkout, true);
        $checkout = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $checkout[] = [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $item['qty'],
                'price' => $product->price,
            ];
        }

        return view('pages.sales.checkout', compact('checkout'));
    }

    public function paymentTransaction(Request $request)
    {
        $request->validate(['cart' => 'required']);

        $cartItems = json_decode($request->cart, true);

        if ($request->is_member == 1) {
            $sub_total = $request->sub_total;
            $amount_paid = $request->amount_paid;
            $phone_number = $request->phone_number;

            $member = Member::where('phone_number', $phone_number)->first();
            $point_get = floor($sub_total / 100);

            if ($member) {
                $member_name = $member->name;
                $point_default = $member->member_point ?? 0;
                $point_total = $point_default + $point_get;
                $transaction_count = $member->sales()->count();
            } else {
                $member_name = null;
                $point_total = $point_get;
                $transaction_count = 0;
            }

            $can_use_point = $transaction_count > 0;

            return view('pages.sales.member', compact(
                'cartItems', 'sub_total', 'amount_paid',
                'member_name', 'phone_number', 'point_total', 'can_use_point'
            ));
        } else {
            $change = $request->amount_paid - $request->sub_total;

            $sale = Sale::create([
                'member_id' => null,
                'date' => now(),
                'no_sales' => 'Invoice - ' . time(),
                'amount_paid' => $request->amount_paid,
                'change' => $change,
                'point_used' => 0,
                'sub_total' => $request->sub_total,
                'total' => $request->sub_total,
                'created_by' => 'Petugas',
            ]);

            foreach ($cartItems as $item) {
                $sale->details()->create([
                    'product_id' => $item['id'],
                    'product_price' => $item['price'],
                    'product_qty' => $item['qty'],
                    'total_price' => $item['qty'] * $item['price'],
                ]);

                Product::find($item['id'])->decrement('stock', $item['qty']);
            }

            return redirect()->route('sales.receipt', $sale->id);
        }
    }

    public function memberTransaction(Request $request)
    {
        $member = Member::where('phone_number', $request->phone_number)->first();
        $point_get = floor($request->sub_total / 100);

        if (!$member) {
            $member = Member::create([
                'name' => $request->member_name,
                'phone_number' => $request->phone_number,
                'member_point' => $point_get,
                'date' => now(),
            ]);
        }

        $use_point = $request->use_point > 0;
        $sub_total = $request->sub_total;
        $amount_paid = $request->amount_paid;

        if ($use_point) {
            $member->update(['member_point' => 0]);
            $point_use = $request->total_point;
            $total = max($sub_total - $point_use, 0);
            $change = $amount_paid - $total;
        } else {
            $member->update(['member_point' => $request->total_point]);
            $point_use = 0;
            $total = $sub_total;
            $change = $amount_paid - $sub_total;
        }

        $sale = Sale::create([
            'member_id' => $member->id,
            'date' => now(),
            'no_sales' => 'Invoice - ' . time(),
            'amount_paid' => $amount_paid,
            'change' => $change,
            'point_used' => $point_use,
            'sub_total' => $sub_total,
            'total' => $total,
            'created_by' => 'Petugas',
        ]);

        $cartItems = json_decode($request->cart, true);

        foreach ($cartItems as $item) {
            $sale->details()->create([
                'product_id' => $item['id'],
                'product_price' => $item['price'],
                'product_qty' => $item['qty'],
                'total_price' => $item['qty'] * $item['price'],
            ]);

            Product::find($item['id'])->decrement('stock', $item['qty']);
        }

        return redirect()->route('sales.receipt', $sale->id);
    }

    public function showReceipt($id)
    {
        $sale = Sale::with(['member', 'details.product'])->find($id);

        if (!$sale) {
            return abort(404, 'Transaksi tidak ditemukan.');
        }

        $saleData = [
            'sale_id' => $sale->id,
            'member_id' => $sale->member?->id,
            'member_name' => $sale->member?->name ?? 'Non-Member',
            'member_phone' => $sale->member?->phone_number ?? '-',
            'member_point' => $sale->member?->member_point ?? 0,
            'member_date' => $sale->member?->date ?? '-',
            'date' => $sale->date,
            'no_sales' => $sale->no_sales,
            'amount_paid' => $sale->amount_paid,
            'change' => $sale->change,
            'point_used' => $sale->point_used,
            'total' => $sale->total,
            'sub_total' => $sale->sub_total,
            'created_at' => $sale->created_at,
            'updated_at' => $sale->updated_at,
            'created_by' => $sale->created_by,

            'products' => $sale->details->map(function ($detail) {
                return [
                    'product_name' => $detail->product?->name ?? 'Produk Dihapus',
                    'qty' => $detail->product_qty,
                    'price' => $detail->product_price
                ];
            })->toArray()
        ];

        return view('pages.sales.receipt', compact('saleData'));
    }


    public function printPDF(Request $request, $id)
    {
        $sale = Sale::with(['member', 'details.product'])->find($id);

        if (!$sale) {
            return abort(404, 'Transaksi tidak ditemukan.');
        }

        $saleData = [
            'sale_id' => $sale->id,
            'member_id' => $sale->member_id,
            'member_name' => $sale->member->name ?? '-',
            'member_phone' => $sale->member->phone_number ?? '-',
            'member_point' => $sale->member->member_point ?? 0,
            'member_date' => $sale->member->date ?? null,
            'date' => $sale->date,
            'no_sales' => $sale->no_sales,
            'amount_paid' => $sale->amount_paid,
            'change' => $sale->change,
            'point_used' => $sale->point_used,
            'total' => $sale->total,
            'sub_total' => $sale->sub_total,
            'created_at' => $sale->created_at,
            'updated_at' => $sale->updated_at,
            'created_by' => $sale->created_by,
            'products' => $sale->details->map(function ($detail) {
                return [
                    'product_name' => $detail->product->name ?? 'Produk tidak ditemukan',
                    'qty' => $detail->product_qty,
                    'price' => $detail->product_price,
                ];
            })->toArray()
        ];

        $pdf = PDF::loadView('pages.sales.pdf.invoice', compact('saleData'));
        $pdfFileName = 'Invoice_' . $id . '.pdf';

        return $pdf->download($pdfFileName);
    }

    public function exportExcel()
    {
        return Excel::download(new SalesExports(), 'sales_report.xlsx');
    }
}
