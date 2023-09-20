<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_products', [ProductController::class, 'list_product']);
Route::post('/add_products', [ProductController::class, 'add_product']);
Route::get('/show_product/{id}', [ProductController::class, 'show_product']);
Route::post('/edit_product/{id}', [ProductController::class, 'edit_product']);
Route::post('/change_status_Pro/{id}', [ProductController::class, 'change_status']);
Route::post('/delete_product/{id}', [ProductController::class, 'delete_product']);
Route::get('/get_category_status1', [ProductController::class, 'get_category']);
Route::get('/get_brand_status1', [ProductController::class, 'get_brand']);

Route::get('/get_brands', [BrandController::class, 'list_brand']);
Route::post('/add_brands', [BrandController::class, 'add_brand']);
Route::get('/show_brand/{id}', [BrandController::class, 'show_brand']);
Route::post('/edit_brand/{id}', [BrandController::class, 'edit_brand']);
Route::post('/delete_brand/{id}', [BrandController::class, 'delete_brand']);
Route::post('/change_status_Brand/{id}', [BrandController::class, 'change_status']);


Route::get('/get_categoris', [CategoryController::class, 'list_category']);
Route::post('/add_category', [CategoryController::class, 'add_category']);
Route::get('/show_category/{id}', [CategoryController::class, 'show_category']);
Route::post('/edit_category/{id}', [CategoryController::class, 'edit_category']);
Route::post('/delete_category/{id}', [CategoryController::class, 'delete_category']);
Route::post('/change_status_Category/{id}', [CategoryController::class, 'change_status']);


Route::post('/test_mail', [CustomerController::class, 'add_customer']);
Route::get('/get_customers', [CustomerController::class, 'list_customer']);
Route::post('/send_email', [CustomerController::class, 'send_email']);
Route::post('/delete_customer/{id}', [CustomerController::class, 'delete_customer']);
