<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;

Route::apiResource('products', ApiProductController::class);
