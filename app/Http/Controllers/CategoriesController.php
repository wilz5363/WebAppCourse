<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function index(){
//        $categories  = Category::all();
        return view('categories.index');
    }
}
