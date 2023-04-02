<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function index() {
       $Products=Products::where('status','=','1')->get();
        return response()->view('sitemap', [
            'Products' => $Products
        ])->header('Content-Type', 'text/xml');
      }
}
