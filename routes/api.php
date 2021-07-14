<?php

use App\Http\Controllers\Api\{LoginController, UserController, OrderController, ReportController, FileController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [LoginController::class, 'index']);
Route::patch('/update-loc/{teknisi:email}', [UserController::class, 'setLoc']);

Route::get('/user/{teknisi:email}', [UserController::class, 'getTeknisi']);
Route::get('/orders/{teknisi:email}', [OrderController::class, 'getOrder']);
Route::get('/order-finish/{teknisi:email}', [OrderController::class, 'getOrderFinish']);
Route::get('/order-payment/{teknisi:email}', [OrderController::class, 'getOrderPayment']);
Route::get('/order-complete/{teknisi:email}', [OrderController::class, 'getOrderComplete']);

// order detail
Route::get('/order/{order:id}', [OrderController::class, 'getDetailOrder']);


Route::get('/report/{teknisi:email}', [ReportController::class, 'report']);
Route::get('/report/detail/{order:id}', [ReportController::class, 'reportDetail']);


Route::get('/report-rev/{job:id}', [ReportController::class, 'reportRevisi']);
Route::post('/report-update/{job:id}', [ReportController::class, 'update']);
Route::post('/upload', [ReportController::class, 'upload']);

Route::get('/download-order/{order:id}', [FileController::class, 'getZip']);
