<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrgnizerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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




// ............ user ...................


Route::get('/home', [UsersController::class, 'index'])->name('index');
Route::post('/user/add', [UsersController::class, 'create'])->name('create');

// ..................... admin .......................
Route::post('/admin/add', [AdminController::class, 'create'])->name('create');


// ..............................  organizer ...........................

Route::post('/organizer/add', [OrgnizerController::class, 'create'])->name('create');

route::group(['middleware' => 'apiToken'], function () {
    // ............ user ...................
    Route::post('/user/edit', [UsersController::class, 'edit'])->name('user_edit');
    Route::post('/user/login', [UsersController::class, 'login'])->name('user_login');

    // ..................... admin .......................
    Route::post('/admin/edit', [AdminController::class, 'edit'])->name('admin_edit');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin_login');
    // ..............................  organizer ...........................
    Route::post('/organizer/edit', [OrgnizerController::class, 'edit'])->name('organizer_edit');
    Route::post('/organizer/login', [OrgnizerController::class, 'login'])->name('organizer_login');

    route::group(['middleware' => 'userAuth'], function () {

        Route::post('/admin/users', [AdminController::class, 'allUsers'])->name('all_users');
        Route::post('/admin/delete_user', [AdminController::class, 'deleteUser'])->name('deleteUser');




    });

// ....................event........................

    route::group(['middleware' => 'userAuth'], function () {

        Route::post('/org/add/event', [EventController::class, 'create_event'])->name('create_event');
        Route::post('/org/edit/event/{id}', [EventController::class, 'edit_event'])->name('edit_event');
        Route::post('/org/del/event/{id}', [EventController::class, 'delete_event'])->name('delete_event');
        Route::post('/org/my-events', [EventController::class, 'get_event'])->name('delete_event');
        Route::post('/events', [EventController::class, 'get_all_event'])->name('get_all_event');
        Route::post('/event/add/fav/{event_id}', [FavoriteController::class, 'add_fav'])->name('add_fav');
        Route::post('/event/remove/fav/{event_id}', [FavoriteController::class, 'remove_fav'])->name('remove_fav');




    });



});
