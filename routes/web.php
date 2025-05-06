<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('role:admin,user');

Route::middleware('role:admin')->group(function () {
    Route::get('/resident', [ResidentController::class, 'index']);
    Route::get('/resident/create', [ResidentController::class, 'create']);
    Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->name('resident.edit');
    Route::post('/resident', [ResidentController::class, 'store'])->name('resident.store');
    Route::put('/resident/{id}', [ResidentController::class, 'update'])->name('resident.update');
    Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->name('resident.delete');

    Route::get('/account-request', [UserController::class, 'accountRequestView'])->name('account-request.index');
    Route::post('/account-request/approval/{id}', [UserController::class, 'accountApproval'])->name('account-request.approval');

    Route::get('/account-list', [UserController::class, 'accountListView'])->name('account-list.index');
});

Route::middleware('role:admin,user')->group(function () {
    Route::get("/profile", [UserController::class, 'profileView']);
    Route::post("/profile/{id}", [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get("/change-password", [UserController::class, 'changePasswordView']);
    Route::post("/change-password/{id}", [UserController::class, 'changePassword'])->name('password.update');
});
