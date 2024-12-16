<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleAuthController;

// Group google authentication
Route::controller(GoogleAuthController::class)->group(function () {
    // login
    Route::get('/', 'index')->name('login')->middleware('guest');

    // user google
    Route::get('/auth/google', 'redirectToGoogle')->name('google.redirect');
    Route::get('/auth/google/callback', 'callbackGoogle')->name('google.callback');

    // admin google
    Route::get('/auth/google/admin', 'redirectToGoogleAdmin')->name('google.redirect.admin');
    Route::get('/auth/google/callback/admin', 'callbackGoogleAdmin')->name('google.callback.admin');

    // Logout route
    Route::delete('/logout', 'logout')->name('logout');
});

// Group user routes
Route::controller(UserController::class)->middleware('auth')->as('user.')->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/donate', 'donate')->name('donate');
    Route::get('/donate/list', 'showDonationById')->name('donate.list');
    Route::post('/donate/insert', "addDonation")->name('donate.insert');
    Route::get('/thankyou', 'thankyou')->name('thankyou');
});

// Group admin routes
Route::controller(AdminController::class)->middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', 'showDonation')->name('dashboard');
    Route::get('/logs', 'indexLogs')->name('logs');
    Route::delete('/delete','deleteDonation')->name('delete');
    Route::put('/restore', 'restoreDonation')->name('restore');
    Route::delete('/trash', 'trashDonation')->name('trash');
    Route::get('/settings', 'settings')->name('settings');
    Route::controller(EventController::class)->prefix('event')->as('event.')->group(function () {
        Route::get('/show', 'showEvents')->name('show');
        Route::post('/add', 'addEvent')->name('add');
        Route::delete('/delete', 'deleteEvent')->name('delete');
        Route::put('/restore', 'restoreEvent')->name('restore');
    });
    Route::post('/new', 'newAdmin')->name('newAdmin');
});

