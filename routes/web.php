<?php
use App\Http\Controllers\AdminCrimeController;
use App\Http\Controllers\UserCrimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/dashboard', function () {
    return auth()->user()->is_admin ? redirect('/admin/crimes') : redirect('/view-crime-database');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/view-crime-database', [UserCrimeController::class, 'index'])->name('view.crime.database');
    Route::get('/report-new-crime', [UserCrimeController::class, 'create'])->name('report.new.crime');
    Route::post('/report-crime-store', [UserCrimeController::class, 'store'])->name('report.crime.store');
    Route::get('/user/crimes/search', [UserCrimeController::class, 'search'])->name('user.crimes.search');
    Route::get('/user/crimes/ajax-search', [UserCrimeController::class, 'ajaxSearch'])->name('user.crimes.ajaxSearch');

});



Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/about/edit', [AboutController::class, 'edit'])->name('admin.about.edit');
    Route::post('/admin/about/update', [AboutController::class, 'update'])->name('admin.about.update');
    Route::get('/admin/crimes/search', [AdminCrimeController::class, 'search'])->name('admin.crimes.search');
    Route::get('/admin/crimes/ajax-search', [AdminCrimeController::class, 'ajaxSearch'])->name('admin.crimes.ajaxSearch');
    Route::get('/admin/crimes', [AdminCrimeController::class, 'index'])->name('admin.crimes.index');
    Route::get('/admin/crimes/create', [AdminCrimeController::class, 'create'])->name('admin.crimes.create');
    Route::post('/admin/crimes', [AdminCrimeController::class, 'store'])->name('admin.crimes.store');
    Route::get('/admin/crimes/{id}/edit', [AdminCrimeController::class, 'edit'])->name('admin.crimes.edit');
    Route::put('/admin/crimes/{id}', [AdminCrimeController::class, 'update'])->name('admin.crimes.update');
    Route::delete('/admin/crimes/{id}', [AdminCrimeController::class, 'destroy'])->name('admin.crimes.destroy');
    Route::patch('/admin/crimes/{id}/approve', [AdminCrimeController::class, 'approve'])->name('admin.crimes.approve');
    Route::patch('/admin/crimes/{id}/disapprove', [AdminCrimeController::class, 'disapprove'])->name('admin.crimes.disapprove');
});


require __DIR__.'/auth.php';
