<?php

use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // ✅ Make sure this is added
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// ✅ Add your migration and seeder routes here
Route::get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return '✅ Migrations complete!';
});

Route::get('/run-seeder', function () {
    Artisan::call('db:seed', ['--force' => true]);
    return '✅ Seeding complete!';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/todos', [TodoController::class, 'todos'])->name('todos');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::post('/todos/update', [TodoController::class, 'update'])->name('todos.update');
    Route::post('/todos/status', [TodoController::class, 'change_status'])->name('todos.status');
    Route::delete('/todos/{id}', [TodoController::class, 'delete']);
});
