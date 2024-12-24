<?php

use App\Filament\Resources\UserDashboardResource\Pages\UserDashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route untuk logout (logout otomatis dan redirect ke halaman login)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/', [WebController::class, 'home']);

Route::get('/login', [FormController::class, 'login'])->name('login');
Route::post('/login', [FormController::class, 'formLogin'])->name('login');
Route::get('/register', [FormController::class, 'register']);
Route::post('/register', [FormController::class, 'formRegister'])->name('register');

Route::get("/search", function () {
    return view("search");
});
Route::get("/kosan/{id}", [WebController::class, 'open']);
Route::post('/submit-payment', [PaymentController::class, 'payment'])->name("submitpayment");
Route::get("/nota", [PaymentController::class, "nota"])->name("nota");

Route::middleware('auth')->group(function () {
    // Route untuk dashboard kelola kosan
    Route::get('/kosan/view/{id}', [WebController::class, 'viewkosan'])->name('view.kosan');
    Route::post('/form/pembayaran', [FormController::class, 'formPembayaran'])->name('form.pembayaran');
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard.index');

    // Route untuk edit kosan
    Route::post('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::post("/addkosan", [FormController::class, "store"])->name("addkosan");
    Route::get("/kelolakosan/edit/{id}", [FormController::class, "edit"]);
    Route::put("/kelolakosan/edit/{id}", [FormController::class, "editkosan"])->name("editkosan");
    Route::get("/getKosan/{id}", [FormController::class, "getKosan"])->name("getkosan");
    Route::get("/kelolakosan/remove/{id}", [FormController::class, "remove"])->name("deletekosan");
    Route::get('/user/remove/{id}', [FormController::class, 'removeUser'])->name('user.remove');
    Route::get("/user-management", [DashboardController::class, "manajemenuser"])->name("manajemenuser");
    Route::get("/facilities", [DashboardController::class, "facilities"])->name("facilities");
    Route::get('/kelola-kosan', [DashboardController::class, "kelolakosan"])->name('dashboard.kelolakosan');
    Route::get('/transaksi', [DashboardController::class, "transaksi"])->name('dashboard.transaksi');
    Route::get('/pembayaran', [FormController::class, "pembayaran"])->name('dashboard.pembayaran');
    Route::get('/logout', [FormController::class, "logout"])->name('logout');
    Route::get("/transactions/delete/{id}", [FormController::class, 'removeTransaksi'])->name('transaksi.remove');
    Route::get("/transactions/markaspaid/{id}", [FormController::class, 'markAsPaid'])->name('transaksi.markaspaid');
});
