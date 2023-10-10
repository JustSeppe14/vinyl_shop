<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::view("/",'home')->name('home');
Route::view("contact",'contact')->name('contact');
Route::view('playground','playground')->name('playground');

Route::prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/admin/records');
    Route::get('admin/records',function (){
        $records = [
            'Queen - <b>Greatest Hits</b>',
            'The Rolling Stones - <i>Sticky Fingers</i>',
            'The Beatles - Abbey Road'
        ];
        return view('admin.records.index',['records' => $records]);
    })->name('records');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
