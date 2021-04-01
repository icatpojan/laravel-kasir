<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $title = "Pengeluran";
        return view('aplication.pages.pengeluaran.index',compact('title'));
    }
}
