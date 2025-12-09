<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

/* ********** Routes for auth ********** */
/* Get redirected to register page */

Route::get('/signUp', [AuthController::class, 'showSignUp'])->name('registration.create')->middleware('guest')->middleware('guest');

/* Post method to register user after user has typed info in */
Route::post('/signUp', [AuthController::class, 'signUp'])->name('registration.store');

/* Get directed to login form */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

/* Method to post log in info and then redirected to main index page as authenticated user */
Route::post('/login', [AuthController::class, 'logIn'])->name('login.store')->middleware('guest');

/* Method to log out the user */
Route::post('/logout', [AuthController::class, 'logOut'])->name('login.destroy')->middleware('auth')->middleware('auth');


/* ********** Routes for EventController ********** */
/* Route for index home page */
Route::get('/', [EventController::class, 'index'])->name('event.index');

/* Route for adding an event */
Route::post('/', [EventController::class, 'create'])->name('event.create.post')->middleware('auth');

/* route just for directing to create blade and thats it*/
Route::get('/create', [EventController::class, 'showCreate'])->name('event.create')->middleware('auth');

/* Route for show more */
Route::get('/{id}', [EventController::class, 'show'])->name('event.show');

/* Route for delete */
Route::delete('/{id}', [EventController::class, 'delete'])->name('event.delete')->middleware('auth');

/* Route for Edit/Update blade */
Route::get('/{id}/edit', [EventController::class, 'edit'])->name('event.edit')->middleware('auth');

/* Route for update */
Route::put('/{id}', [EventController::class, 'update'])->name('event.update')->middleware('auth');
