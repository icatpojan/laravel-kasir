<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class PenjualanController extends Controller
{

    public function index()
    {
        $title = "Kasir";
        $Penjualan = Penjualan::where('status', 0)->where('id_kasir', Auth::id())->first();
        $Product = Product::all();

        if ($Penjualan == []) {
            $Cart = [];
            return view('aplication.pages.kasir.index', compact('Cart', 'Product', 'Penjualan', 'title'));
        }
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        return view('aplication.pages.kasir.index', compact('title', 'Cart', 'Product', 'Penjualan'));
    }
    public function store(Request $request)
    {
        $Product = Product::where('barcode', $request->barcode)->first();
        if (!$Product) {
            alert()->error('not fon', 'barang tidak ada. pastikan barcode');
            return back();
        }
        $cek_penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_penjualan)) {
            $Penjualan = Penjualan::create([
                'id_kasir' => Auth::user()->id,
                'status' => 0,
                'jumlah_harga' => 0,
                'status' => 0,
            ]);
            $Penjualan->save();
        }
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        // ambil data penjualan lagi
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->where('barcode', $request->barcode)->first();
        if (!($Cart == [])) {
            $Cart->jumlah_product = ($Cart->jumlah_product) + 1;
            $Cart->jumlah_harga = ($Cart->jumlah_harga) + ($Product->harga_jual);
            $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->jual);
            $Penjualan->update();
            $Penjualan->harus_dibayar = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($Penjualan->diskon / 100));
            $Cart->update();
            $Penjualan->update();
            // alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
            return back();
        }
        $Cart = Cart::create([
            'name' => $Product->name,
            'jumlah_product' => 1,
            'category_id' => $Product->category_id,
            'barcode' => $Product->barcode,
            'jual' => $Product->harga_jual,
            'jumlah_harga' => ($Product->harga_jual),
            'penjualan_id' => $Penjualan->id,
            'status' => 0
        ]);
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->jumlah_harga);
        $Penjualan->update();
        $Penjualan->harus_dibayar = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($Penjualan->diskon / 100));
        $Penjualan->update();
        $Cart->save();
        // alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }

    public function update(Request $request, $id)
    {
        // refresh dulu harga penjualan
        $Cart = Cart::where('id', $id)->first();
        $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - ($Cart->jumlah_harga);
        $Penjualan->update();

        // update cartnya
        $Cart->jumlah_product = $request->jumlah_product;
        $Cart->jumlah_harga = ($request->jumlah_product) * ($Cart->jual);
        $Cart->update();

        // masukin lagi ke penjualan
        // $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->jumlah_harga);
        $Penjualan->update();
        $Penjualan->harus_dibayar = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($Penjualan->diskon / 100));
        $Penjualan->update();
        return back();
    }
    public function bayar(Request $request)
    {
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if ($Penjualan->jumlah_harga == 0) {
            alert()->error('lho', 'kok gak ada barang?');
            return back();
        }
        if ($Penjualan->jumlah_harga > $request->dibayar) {
            alert()->error('KANTONG KERING', 'Duit anda kurang');
            return back();
        } else {
            $Penjualan->dibayar = $request->dibayar;
            $Penjualan->kembalian = $request->dibayar - $Penjualan->harus_dibayar;
            $Penjualan->update();
            alert()->success('OK', 'yosh');
            return back();
        }
    }
    public function diskon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'integer',
            // 'diskon' => 'integer',
        ]);
        $diskon = rand(1, 20);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Member = Member::where('member_id', $request->member_id)->first();
        if ($Member == []) {
            alert()->error('not fon', 'member tidak ada');
            return back();
        }
        if (!($Penjualan->diskon == 0)) {
            alert()->error('STOP', 'sudah didiskon');
            return back();
        }
        $Penjualan->harus_dibayar = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($diskon / 100));
        $Penjualan->member_id = $request->member_id;
        $Penjualan->diskon = $diskon;
        $Penjualan->update();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public static function cetak_pdf()
    {
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();

        $pdf = PDF::loadview('report.kasir_pdf', compact('Cart'));
        // return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-kasir-pdf');
    }
    public function confirm(Request $request)
    {
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if ($Penjualan == null || $Penjualan->jumlah_harga == 0 || $Penjualan == []) {
            alert()->error('KOSONG', 'anda belom masukin apapun');
            return back();
        }
        if ($Penjualan->dibayar < $Penjualan->jumlah_harga) {
            alert()->error('HOY', 'Yang dibayar kurang');
            return back();
        }
        if ($Penjualan->dibayar == null) {
            alert()->error('KOSONG', 'bayar dulu dong');
            return back();
        }
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        foreach ($Cart as $Data) {
            $Product = Product::where('barcode', $Data->barcode)->first();
            if ($Product->stock = $Product->stock < $Data->jumlah_product) {
                alert()->error('KOSONG', 'barang kurang');
                return back();
            }
        }
        if ($request->has('cetak')) {
            $pdf = PDF::loadview('report.kasir_pdf', compact('Cart'));
            // return $pdf->download('laporan-penjualan-pdf');
            return $pdf->stream('nota-kasir-pdf');
        }
        foreach ($Cart as $Data) {
            $Carts = Cart::find($Data->id);
            $Carts->status = 1;
            $Carts->update();
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Product->stock = ($Product->stock) - ($Data->jumlah_product);
            $Product->update();
        }

        $Penjualan->status = 1;
        $Penjualan->update();
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 1)->latest()->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 1)->get();
        $Keuangan = Keuangan::latest()->first();
        Keuangan::create([
            'keterangan' => 'Penjualan',
            'debit' => $Penjualan->harus_dibayar,
            'saldo' => ($Keuangan->saldo) + ($Penjualan->harus_dibayar),
        ]);
        foreach ($Cart as $Data) {
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Keuangan = Keuangan::latest()->first();
            $Keuangan->laba = ($Keuangan->laba) + ($Data->jumlah_product * (($Product->harga_jual) - ($Product->harga_beli)));
            $Keuangan->update();
        }
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public function destroy($id)
    {
        $Cart = Cart::where('id', $id)->first();
        if (!$Cart) {
            return $this->sendResponse('error', 'data tidak ada', null, 200);
        }
        $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - ($Cart->jumlah_harga);
        $Penjualan->update();
        $Penjualan->harus_dibayar = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($Penjualan->diskon / 100));
        $Penjualan->update();
        $Cart->delete();
        alert()->success('SuccessAlert', 'BRAZIL');
        return back();
    }
}
