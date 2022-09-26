<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;



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


Route::post('/commentstore', [CommentController::class, 'commentstore'])->name('commentstore');
Route::get('/commentsshow/{id}', [CommentController::class, 'commentsshow']);
Route::post('comment/approve', [CommentController::class, 'commentapprove']);


Route::get('ticket', [TicketController::class, 'index'])->name('ticket');
Route::get('ticket/list', [TicketController::class, 'ticketList']);
Route::post('ticket/add', [TicketController::class, 'ticketAdd']);
Route::get('ticket/{id}', [TicketController::class, 'ticketEdit']);
Route::post('ticket/{id}', [TicketController::class, 'ticketUpdate']);

Route::get('message/list/{ticket_id}', [TicketController::class, 'messageList']);
Route::post('message/add', [TicketController::class, 'messageAdd']);
