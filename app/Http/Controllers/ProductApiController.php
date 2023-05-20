<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductApiController extends Controller
{
    function product_list(){
        return Product::select('id', 'product_name')->get();
    }

}
