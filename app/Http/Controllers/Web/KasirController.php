<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Category;
use App\Model\data;
use App\Model\Keuangan;
use App\Model\Penjualan;
use Illuminate\Http\Request;
use PDF;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Penjualan';
        $Total_penjualan = Penjualan::whereDay('created_at', date('d'))->sum('jumlah_harga');
        $Total_bulanan = Penjualan::whereMonth('created_at', date('m'))->sum('jumlah_harga');
        $Cart = Cart::whereDay('created_at', date('d'))->sum('jumlah_product');
        $Penjualan = Penjualan::all();
        $Category = Category::all();
        $baris = [];
        $baris = array();
        foreach ($Category as $value) {
            $id = $value->id;
            $name = $value->name;
            $Cart = Cart::whereDay('created_at', date('d'))->where('category_id', $id)->sum('jumlah_harga');
            $baris = data::create([
                'tanggal' => $name,
                'pembelian' => $Cart,
            ]);
            $baris = data::all();
        }
        foreach ($baris as $Data) {
            $del = data::find($Data->id);
            $del->delete();
        }
        if ($request->awal == null) {
            $row = null;
            return view('aplication.pages.penjualan.penjualan', compact('Penjualan', 'Total_penjualan', 'Total_bulanan', 'Cart', 'row', 'title', 'Category', 'baris'));
        } else
            $no = 0;
        $data = [];
        $pendapatan = 0;
        $total_pendapatan = 0;
        $row = [];
        $row = array();
        while (strtotime($request->awal) <= strtotime($request->akhir)) {
            $tanggal = $request->awal;
            $request->awal = date('Y-m-d', strtotime("+1 day", strtotime($request->awal)));

            $total_penjualan = Cart::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_product');
            $total_pembelian = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
            $laba = Keuangan::where('created_at', 'LIKE', "$tanggal%")->sum('laba');

            $row = data::create([
                'tanggal' => $tanggal,
                'penjualan' => $total_penjualan,
                'pembelian' => $total_pembelian,
                'laba' => $laba,
            ]);
            $row = data::paginate(10);
        }

        foreach ($row as $Data) {
            $del = data::find($Data->id);
            $del->delete();
        }

        return view('aplication.pages.penjualan.penjualan', compact('Penjualan', 'Total_penjualan', 'Total_bulanan', 'Cart', 'row', 'title', 'laba', 'Category', 'baris'));
    }
    public function cetak_pdf()
    {
        $Penjualan = Penjualan::all();

        $pdf = PDF::loadview('report.penjualan_pdf', compact('Penjualan'))->setPaper('a4', 'landscape');
        // return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-penjualan-pdf');
    }
    public function show($id)
    {
        $title = 'apa ajalah';
        $Cart = Cart::where('penjualan_id', $id)->get();
        return view('aplication.pages.penjualan.show', compact('Cart', 'title'));
    }
}
