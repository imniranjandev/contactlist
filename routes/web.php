<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* 
Route::get('/', function () {
    return view('upload');
});

Route::post('/upload-xml', [ContactController::class, 'uploadXML']); */

Route::get('/', [ContactController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [ContactController::class, 'uploadXml'])->name('upload.xml');
