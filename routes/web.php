<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', function (){
    return view('home');
});


Route::post('/create_link_token', [HomeController::class, 'createLinkToken']);
Route::post('/accounts', [HomeController::class, 'accounts']);
Route::post('/transactions', [HomeController::class, 'transactions']);


Route::get('/home', [HomeController::class, 'index']);
