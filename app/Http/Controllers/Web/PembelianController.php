<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Kulakan;
use App\Model\Pembelian;
use App\Model\Supplier;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function index()
    {
        $title = 'Pembelian';
        $Kulakan = Kulakan::where('user_id', Auth::id())->where('status', 0)->first();
        if ($Kulakan) {
            $Kulakan = Kulakan::where('user_id', Auth::id())->where('status', 0)->first();
            $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
            $Supplier = Supplier::where('id', $Kulakan->supplier_id)->first();
            $Product = Product::all();
            return view('aplication.pages.pembelian.pembelian', compact('Kulakan', 'Product', 'Supplier', 'Pembelian'));
        }
        $Kulakan = kulakan::with(['user'])->get();
        // $Product = Product::all();
        $Supplier = Supplier::all();
        return view('aplication.pages.pembelian.index', compact('Kulakan', 'Supplier','title'));
    }
    public function form(Request $request)
    {
        $Supplier = Supplier::where('id', $request->id)->first();
        $Kulakan = Kulakan::where('user_id', Auth::id())->where('status', 0)->first();
        $Product = Product::all();
        if ($Kulakan == []) {
            $Pembelian = [];
            return view('aplication.pages.pembelian.pembelian', compact('Kulakan', 'Product', 'Supplier', 'Pembelian'));
        }
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
        return view('aplication.pages.pembelian.pembelian', compact('Kulakan', 'Product', 'Supplier', 'Pembelian'));
    }
    public function see()
    {
        $Kulakan = Kulakan::where('user_id', Auth::user()->id)->where('status', 1)->letest()->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 1)->get();
        if ($Pembelian == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Pembelian bos', $Pembelian, 200);
    }
    public function store(Request $request)
    {
        $Product = Product::where('barcode', $request->barcode)->first();
        if (!$Product) {
            alert()->error('ErrorAlert', 'pastikan barcod anda enar');
            return back();
        }
        // dd(Auth::id());
        $cek_kulakan = Kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_kulakan)) {
            $Kulakan = Kulakan::create([
                'user_id' => Auth::user()->id,
                'tanggal' => Carbon::now(),
                'status' => 0,
                'jumlah_harga' => 0,
                'supplier_id' => $request->supplier_id,
            ]);
            $Kulakan->save();
        }
        $Kulakan = Kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('barcode', $Product->barcode)->first();
        if (!($Pembelian == [])) {
            $Pembelian->jumlah_product = $Pembelian->jumlah_product + 1;
            $Pembelian->jumlah_harga = $Pembelian->jumlah_harga + $Product->harga_beli;
            $Pembelian->update();
            $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Product->harga_beli);
            $Kulakan->update();
            $Kulakan->bayar = ($Kulakan->jumlah_harga) - (($Kulakan->jumlah_harga) * ($Kulakan->diskon / 100));
            $Kulakan->update();
            return back();
        }
        $Pembelian = Pembelian::create([
            'name' => $Product->name,
            'harga' => $Product->harga_beli,
            'jumlah_product' => 1,
            'supplier_id' => $request->supplier_id,
            'barcode' => $Product->barcode,
            'kulakan_id' => $Kulakan->id,
            'status' => 0,
            'jumlah_harga' => $Product->harga_beli
        ]);
        $Pembelian->save();
        $Kulakan = Kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Product->harga_beli);
        $Kulakan->update();
        $Kulakan->bayar = ($Kulakan->jumlah_harga) - (($Kulakan->jumlah_harga) * ($Kulakan->diskon / 100));
        $Kulakan->update();
        // alert()->success('SuccessAlert', 'barhasil');
        return back();
    }
    public function update(Request $request, $id)
    {
        $Pembelian = Pembelian::where('id', $id)->first();
        $Kulakan = Kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) - ($Pembelian->jumlah_harga);
        $Kulakan->update();

        $Pembelian->jumlah_product = $request->jumlah_product;
        $Pembelian->jumlah_harga = ($request->jumlah_product) * ($Pembelian->harga);
        $Pembelian->update();

        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Pembelian->jumlah_harga);
        $Kulakan->update();
        $Kulakan->bayar = ($Kulakan->jumlah_harga) - (($Kulakan->jumlah_harga) * ($Kulakan->diskon / 100));
        $Kulakan->update();
        return back();
    }
    public function confirm()
    {
        $Kulakan = Kulakan::where('user_id', Auth::user()->id)->where('status', 0)->latest()->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
        $Keuangan = Keuangan::latest()->first();
        if ($Keuangan->saldo < $Kulakan->bayar) {
            alert()->error('KANTONG KERING', 'saldo anda kurang');
            return back();
        }
        foreach ($Pembelian as $Data) {
            $Pembelians = Pembelian::find($Data->id);
            $Pembelians->status = 1;
            $Pembelians->update();
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Product->stock = ($Product->stock) + ($Data->jumlah_product);
            $Product->update();
        }
        Keuangan::create([
            'keterangan' => 'pembelian',
            'kredit' => $Kulakan->bayar,
            'saldo' => ($Keuangan->saldo) - ($Kulakan->bayar)
        ]);
        $Kulakan->status = 1;
        $Kulakan->update();

        alert()->success('SuccessAlert', 'Berhasil');
        return Redirect('pembelian');
    }
    public function destroy($id)
    {
        $Pembelian = Pembelian::where('id', $id)->first();
        if (!$Pembelian) {
            alert()->error('ErrorAlert', 'data tidak ada');
            return back();
        }
        $Kulakan = Kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) - ($Pembelian->jumlah_harga);
        $Kulakan->update();
        $Kulakan->bayar = ($Kulakan->jumlah_harga) - (($Kulakan->jumlah_harga) * ($Kulakan->diskon / 100));
        $Kulakan->update();
        $Pembelian->delete();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public function diskon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diskon' => 'integer',
        ]);
        $Kulakan = Kulakan::where('user_id', Auth::id())->where('status', 0)->first();
        $Kulakan->diskon = $request->diskon;
        $Kulakan->bayar = ($Kulakan->jumlah_harga) - (($Kulakan->jumlah_harga) * ($request->diskon / 100));
        $Kulakan->update();
        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public function kembali()
    {
        $Kulakan = Kulakan::where('user_id', Auth::id())->where('status', 0)->first();
        if ($Kulakan) {
            $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
            foreach ($Pembelian as $value) {
                $value->delete();
            }
            $Kulakan->delete();
            return redirect('pembelian');
        }
        return redirect('pembelian');
    }
    public function show($id)
    {
        $Pembelian = Pembelian::where('kulakan_id', $id)->get();
        return view('pages.pembelian.show', compact('Pembelian'));
    }
}
