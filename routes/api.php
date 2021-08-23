<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\Country;

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


/*
|--------------------------------------
|   INTERNAL FRONTEND AUTHORIZED
|--------------------------------------
*/
// Route::middleware('auth:api')->group( function() {

//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });

//     Route::get('/listings', function() {
//         return Listing::all();
//     });

//     Route::get('/countries', function() {
//         return Country::all();
//     });

//     Route::get('/listings/search/{query}', function($query) {
//         return Listing::search($query)->get();
//     });
        
// });


