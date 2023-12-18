<?php

use App\Livewire\Admin\Genres;
use App\Livewire\Admin\Records;
use App\Livewire\Admin\UsersBasic;
use App\Livewire\Demo;
use App\Livewire\Shop;
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
Route::view("contact",'contact')->name('contact');
Route::view('playground','playground')->name('playground');
Route::view('under-construction','under-construction')->name('under-construction');
Route::get('mail',function (){
    $me = ['name'=>config('mail.from.name')];
    return view('mail',$me);
})->name('mail');


Route::middleware(['auth','admin','active'])->prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/admin/records');
    Route::get('records',Records::class)->name('records');
    Route::get('genre',Genres::class)->name('genre');
    Route::get('users/basic', UsersBasic::class)->name('users.basic');
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
