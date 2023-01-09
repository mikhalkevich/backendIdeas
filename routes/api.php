<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

//auth routes
Route::middleware(['auth:sanctum','admin'])->group(function () {
    //profile
    Route::post('logout', [Controllers\AuthController::class, 'logout']);
    Route::get('profile', [Controllers\AuthController::class, 'profile']);
    //product
    Route::resource('product', Controllers\ProductController::class)->except('edit', 'create');
    Route::post('idea/{product}/add_picture', [Controllers\MediaController::class, 'addPictureToProduct']);
    Route::post('idea/{product}/add_catalog/', [Controllers\ProductController::class, 'addCatalog']);
    Route::post('idea/{product}/add_company/', [Controllers\ProductController::class, 'addCompany']);
    Route::delete('idea/{product}/detach_picture', [Controllers\MediaController::class, 'detachPicture']);
    Route::delete('idea/{product}/detach_catalog/', [Controllers\ProductController::class, 'detachCatalog']);
    Route::delete('idea/{product}/detach_company/', [Controllers\ProductController::class, 'detachCompany']);
    //company
    Route::resource('company', Controllers\CompanyController::class)->except('edit', 'create');
    //catalog
    Route::resource('catalog', Controllers\CatalogController::class)->except('edit', 'create');
});
Route::post('register', [Controllers\AuthController::class, 'register']);
Route::post('login', [Controllers\AuthController::class, 'login']);
//public routes
Route::prefix('public')->group(function (){
    Route::get('ideas', [Controllers\ProductController::class, 'publicShow']);
    Route::get('ideas_with_paginate', [Controllers\ProductController::class, 'publicPaginate']);
    Route::get('idea/{id}', [Controllers\ProductController::class, 'publicOne']);
});
