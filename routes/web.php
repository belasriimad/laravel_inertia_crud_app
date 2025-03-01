<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //contacts routes
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('contacts/add', [ContactController::class,'create']);
    Route::post('contacts/add', [ContactController::class,'store'])->name('contacts.store');
    Route::get('contacts/{contact}/edit', [ContactController::class,'edit']);
    Route::put('contacts/update/{contact}', [ContactController::class,'update'])->name('contacts.update');
    Route::delete('contacts/delete/{contact}', [ContactController::class,'delete']);
    Route::get('order/{direction}/contacts', [ContactController::class,'getContactsOrderedByName']);
    Route::get('add/contact/{contact}/favorites', [ContactController::class,'addToFavorites']);
    Route::get('favorites/contacts', [ContactController::class,'favoriteContacts']);
    Route::get('search/contacts', [ContactController::class,'findContactsByName'])->name('find.contacts');
    //user routes
    Route::post('user/logout', [UserController::class,'logout']);
});

//user guest routes
Route::get('user/register', [UserController::class,'create']);
Route::post('user/register', [UserController::class,'store'])->name('user.store');
Route::get('user/login', [UserController::class,'login'])->name('login');
Route::post('user/login', [UserController::class,'auth'])->name('user.auth');

