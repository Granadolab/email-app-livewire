<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\UserManagementController;
use App\Http\Livewire\UserManagement;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/users-management', [UserManagementController::class, 'index'])->name('users-management');
Route::post('/users-management', [UserManagementController::class, 'store'])->name('users-management-store');
Route::get('/mail', [MailController::class, 'index'])->name('mails');

