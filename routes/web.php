<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::delete('/blog/{id}', [AuthController::class, 'blogDelete']);
Route::get('/blog/{id}', [AuthController::class, 'blogEdit']);
Route::post('/blog/{id}', [AuthController::class, 'blogUpdate']);
Route::post('/blog', [AuthController::class, 'blogcreate']);
Route::resource('roles', RoleController::class);

Route::get('/', [BlogController::class, 'index']);


//--CREATE a link--//
// Route::post('/links', function (Request $request) {
//     $link = Link::create($request->all());
//     return Response::json($link);
// });

//--GET LINK TO EDIT--//
// Route::get('/links/{link_id?}', function ($link_id) {
//     $link = Link::find($link_id);
//     return Response::json($link);
// });

//--UPDATE a link--//
// Route::put('/links/{link_id?}', function (Request $request, $link_id) {
//     $link = Link::find($link_id);
//     $link->url = $request->url;
//     $link->description = $request->description;
//     $link->save();
//     return Response::json($link);
// });

//--DELETE a link--//
// Route::delete('/links/{link_id?}', function ($link_id) {
//     $link = Link::destroy($link_id);
//     return Response::json($link);
// });
