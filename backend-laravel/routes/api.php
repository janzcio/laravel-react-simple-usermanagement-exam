<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// User Routes
// Route to create a new user
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route to retrieve users, optionally filtered by role
// Example Request: /api/users?role_id=1&groupbyrole=true
Route::get('/users', [UserController::class, 'getUserByRole'])->name('users.index');

// Role Routes
// Route to retrieve all roles
Route::get('/roles', [RoleController::class, 'getRoles'])->name('roles.index');
