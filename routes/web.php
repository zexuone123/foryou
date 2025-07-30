<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UcapanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/gallery', function () {
    // ambil semua file dari folder public/images
    $files = File::files(public_path('images'));
    $images = [];
    foreach ($files as $file) {
        $images[] = 'images/' . $file->getFilename();
    }
    return view('gallery', compact('images'));
});

Route::get('/', function () {
    // foto slideshow yang ada di folder public/images/
    $slideshow = [
        'images/ultah1.jpg',
        'images/ultah2.jpg',
        'images/ultah3.jpg',
    ];

    return view('welcome', [
        'nama' => 'Nama yang Ulang Tahun',
        'slideshow' => $slideshow
    ]);
});

Route::get('/gallery', function () {
    $files = \Illuminate\Support\Facades\File::files(public_path('images'));
    $images = [];
    foreach ($files as $file) {
        $images[] = 'images/' . $file->getFilename();
    }
    return view('gallery', compact('images'));
});

Route::get('/', function () {
    // Baca semua file gambar dari folder public/images/ultah
    $files = File::files(public_path('images/ultah'));
    $slideshow = [];
    foreach ($files as $file) {
        $ext = strtolower($file->getExtension());
        if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            $slideshow[] = 'images/ultah/' . $file->getFilename();
        }
    }
    // Ambil hanya 10 pertama
    $slideshow = array_slice($slideshow, 0, 10);

    return view('welcome', [
        'nama' => 'Nama yang Ulang Tahun',
        'slideshow' => $slideshow
    ]);
});

Route::get('/gallery', function () {
    $files = File::files(public_path('images'));
    $images = [];
    foreach ($files as $file) {
        $images[] = 'images/' . $file->getFilename();
    }
    return view('gallery', compact('images'));
});