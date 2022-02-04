<?php


use App\Http\Controllers\API\MultipleUploadController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/users/me', '\App\Api\Controllers\SessionController@currentUser');
    Route::get('/logout', '\App\Api\Controllers\SessionController@logout');

    Route::apiResource('/users', '\App\Api\Controllers\UserController');
    Route::put('/users/{slug}/update-password', '\App\Api\Controllers\UserController@changePassword');

    Route::get('/avatars', '\App\Api\Controllers\AvatarsController@get');
    Route::post('/avatars', '\App\Api\Controllers\AvatarsController@upload');
    Route::put('/avatars', '\App\Api\Controllers\AvatarsController@update');
    Route::delete('/avatars', '\App\Api\Controllers\AvatarsController@delete');
});

/**
 * Password reset endpoints
 */
Route::post('/forgot-password', '\App\Api\Controllers\PasswordResetController@forgotPassword');
Route::post('/reset-password', '\App\Api\Controllers\PasswordResetController@resetPassword');

/**
 * These endpoints return JWT's, so make sure to wrap them in the encrypt cookies
 * middleware.
 */
Route::group(['middleware' => ['encryptCookies']], function () {
    Route::post('/login', '\App\Api\Controllers\SessionController@login');
    Route::post('/signup', '\App\Api\Controllers\UserController@signup');
});

// Product routes

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Product image routes

Route::post('/upload', [ProductImageController::class, 'upload']);

// Inventory routes

Route::get('/inventories', [InventoryController::class, 'index']);
Route::get('/inventories/{id}', [InventoryController::class, 'show']);
Route::get('/inventories/search/{name}', [InventoryController::class, 'search']);
Route::post('/inventories', [InventoryController::class, 'store']);
Route::put('/inventories/{id}', [InventoryController::class, 'update']);
Route::delete('/inventories/{id}', [InventoryController::class, 'destroy']);

// Order routes

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::get('/orders/search/{name}', [OrderController::class, 'search']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

// Shipment routes

Route::get('/shipments', [ShipmentController::class, 'index']);
Route::get('/shipments/{id}', [ShipmentController::class, 'show']);
Route::get('/shipments/search/{name}', [ShipmentController::class, 'search']);
Route::post('/shipments', [ShipmentController::class, 'store']);
Route::put('/shipments/{id}', [ShipmentController::class, 'update']);
Route::delete('/shipments/{id}', [ShipmentController::class, 'destroy']);

// Report routes

Route::get('reports/completed-orders{format}', 'ReportController@getCompletedOrders');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'online' => true,
        'message' => 'API is responding correctly.',
    ], 200);
});
