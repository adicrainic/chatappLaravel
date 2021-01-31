<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/container');
})->name('chat');

Route::middleware(['auth:sanctum', 'verified'])->get('/newRoom', function () {
    return Inertia::render('Chat/createRoomForm');
})->name('createRoomForm');

Route::middleware(['auth:sanctum', 'verified'])->get('/administration', function () {
    return Inertia::render('Administration');
})->name('administration');


Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);

Route::middleware('auth:sanctum')->post('/chat/newRoom', [ChatController::class, 'newRoom']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'users']);
Route::middleware('auth:sanctum')->delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
Route::middleware('auth:sanctum')->post('/user/create', [UserController::class, 'createUser']);


