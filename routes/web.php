<?php

use Illuminate\Support\Facades\Route;
//use Symfony\Component\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// GROUP ROUTER
//Route::namespace('Admin')->prefix('admin')->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The '/admin/users' URL
        return "Hello Users";
    });
    Route::get('posts', function () {
        // Matches The '/admin/users' URL
        return "Hello Post";
    });

    Route::get('users/{userId}', function($userId){
        return "User Id : " . $userId;
    })->where('userId', '[0-9]+');

    // METHOD ONE
    Route::get('testlist', 'Admin\TestController@listUsers');

});


Route::get("/", "UserController@index");
Route::post("/userdata", "UserController@userdata");
Route::get("/edit-users/{id}", "UserController@editusers");
Route::get("/delete-users/{id}", "UserController@delete_user_data");
Route::post("/update-userdata", "UserController@update_userdata");

Route::resource('questions', 'QuestionController');
/*
Route::match(['get', 'post'], '/', function () {
});

Route::any('foo', function () {
echo "asda";exit;
});

Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
 */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


