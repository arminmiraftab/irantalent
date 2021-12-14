<?php

use App\Http\Controllers\api\CountryController;
use App\Http\Controllers\api\Skill_userController;
use App\Http\Controllers\api\SkillController;
use App\Http\Controllers\API\UserController;
use App\Models\skill;
use App\Models\skill_user;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::Resources([
//    'user' => UserController::class,
//]);
Route::resources([
    'user' => UserController::class
]);
Route::resources([
    'skill_user' => Skill_userController::class
]);
Route::resources([
    'skill' => SkillController::class
]);
