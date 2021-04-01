<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "Category";
        return view('aplication.pages.category.index',compact('title'));
    }
}
