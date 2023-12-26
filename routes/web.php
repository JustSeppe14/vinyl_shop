<?php

use App\Livewire\Admin\Genres;
use App\Livewire\Admin\Genres2;
use App\Livewire\Admin\Records;
use App\Livewire\Demo;
use App\Livewire\Demo2;
use App\Livewire\Shop;
use App\Livewire\Shop2;
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
Route::get('shop',Shop::class)->name('shop');
Route::get('shop2',Shop2::class)->name('shop2');
Route::view("contact",'contact')->name('contact');
Route::view('playground','playground')->name('playground');
Route::view('under-construction','under-construction')->name('under-construction');
Route::get('mail',function (){
    $me = ['name'=>config('mail.from.name')];
    return view('mail',$me);
})->name('mail');
Route::prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/admin/records2');
    Route::get('records2',Demo2::class)->name('records2');
});


Route::middleware(['auth','admin','active'])->prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/admin/records');
    Route::get('records',Records::class)->name('records');
    Route::get('genres',Genres::class)->name('genres');
    Route::get('genres2',Genres2::class)->name('genres2');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'active',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
