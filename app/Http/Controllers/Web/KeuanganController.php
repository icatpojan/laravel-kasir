<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Category;
use App\Model\data;
use App\Model\Keuangan;
use App\Model\Pembelian;
use App\Model\Pengeluaran;
use App\Model\Penjualan;
use App\Product;
use Illuminate\Http\Request;
use PDF;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Keuangan';
        $Keuangan = Keuangan::latest()->paginate(5);
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereMonth('created_at', date('m'))->sum('debit');
        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereMonth('created_at', date('m'))->sum('debit');
        $jumlah_pengeluaran = Pengeluaran::whereMonth('created_at', date('m'))->sum('kredit');
        $saldo = Keuangan::sum('debit') - Keuangan::sum('kredit');
        $Product = Product::all('name', 'stock');
        $harian_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereDay('created_at', date('d'))->sum('debit');
        $harian_pembelian = Keuangan::where('keterangan', 'pembelian')->whereDay('created_at', date('d'))->sum('kredit');
        $bulanan_laba = Keuangan::whereMonth('created_at', date('m'))->sum('laba');
        $harian_laba = Keuangan::whereDay('created_at', date('d'))->sum('laba');
        $Category = Category::all();
        $harian_pengeluaran = Pengeluaran::whereDay('created_at', date('d'))->sum('kredit');
        if ($request->awal == null) {
            $row = null;
            return view('aplication.pages.keuangan.index', compact('Keuangan', 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'harian_penjualan',  'harian_pembelian',  'harian_pengeluaran', 'saldo', 'row', 'title', 'bulanan_laba', 'harian_laba','Category'));
        } else {
            $no = 0;
            $data = [];
            $pendapatan = 0;
            $total_pendapatan = 0;
            $row = [];
            $row = array();
            while (strtotime($request->awal) <= strtotime($request->akhir)) {
                $tanggal = $request->awal;
                $request->awal = date('Y-m-d', strtotime("+1 day", strtotime($request->awal)));

                $total_penjualan = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
                $total_pembelian = Pembelian::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
                $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "$tanggal%")->sum('kredit');

                $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
                $total_pendapatan += $pendapatan;

                $row = data::create([
                    'tanggal' => $tanggal,
                    'penjualan' => $total_penjualan,
                    'pembelian' => $total_pembelian,
                    'pengeluaran' => $total_pengeluaran,
                    'pendapatan' => $pendapatan
                ]);
                $row = data::all();
            }
            foreach ($row as $Data) {
                $del = data::find($Data->id);
                $del->delete();
            }
            return view('aplication.pages.keuangan.index', compact('Keuangan', 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'harian_penjualan',  'harian_pembelian',  'harian_pengeluaran', 'saldo', 'row', 'title', 'bulanan_laba', 'harian_laba','Category'));
        }
    }

    public function per(Request $request)
    {
        $row = [];
        $row = array();
        while (strtotime($request->awal) <= strtotime($request->akhir)) {
            $tanggal = $request->awal;
            $request->awal = date('Y-m-d', strtotime("+1 day", strtotime($request->awal)));
            $Cart = Cart::where('created_at', 'LIKE', "$tanggal%")->where('category_id', $request->category_id)->sum('jumlah_harga');
            $row = data::create([
                'tanggal' => $tanggal,
                'penjualan' => $Cart,
            ]);
            $row = data::all();
        }
        foreach ($row as $Data) {
            $del = data::find($Data->id);
            $del->delete();
        }
        $title = 'apa ajalah';
        return view('aplication.pages.keuangan.show', compact('row', 'title'));
    }

    public function cetak_pdf()
    {
        $Keuangan = Keuangan::all();

        $pdf = PDF::loadview('report.keuangan_pdf', compact('Keuangan'));
        // return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-keuangan-pdf');
    }
}
