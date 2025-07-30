<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
{
    $nama = "Salsa"; // contoh nama
    $slideshow = [];

    // Ambil semua foto dari folder public/images/ultah
    $files = glob(public_path('images/ultah/*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}'), GLOB_BRACE);

    // Acak urutannya
    shuffle($files);

    foreach($files as $file) {
        $slideshow[] = 'images/ultah/' . basename($file);
    }

    return view('welcome', compact('slideshow','nama'));
}

    
    
}


