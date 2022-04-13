<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login_form');
});


Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'UserController@showLoginForm')->name('login_form');
        Route::post('/login', 'UserController@login')->name('login');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/logout', 'UserController@logout')->name('logout');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/summary', 'HomeController@summary')->name('summary');

        // For assessment
        Route::get('/{kode}/showArticleByKode', 'ArticleQuestionnaireController@showArticleByKode')->name('showArticleByKode');
        Route::get('/{article_id}/viewScore', 'ArticleQuestionnaireController@viewScore')->name('viewScore');
        Route::get('/{article_id}/assess', 'ArticleQuestionnaireController@assess')->name('assess');
        Route::post('/{article_id}/submit', 'ArticleQuestionnaireController@submit')->name('submit');

        // For user management
        Route::post('/storeUser', 'UserController@store');
        Route::post('/{user_id}/updateUser', 'UserController@update');

        // For article management
        Route::get('/{article_id}/editArticle', 'ArticleController@edit')->name('editArticle');
        Route::post('/{article_id}/updateArticle', 'ArticleController@update')->name('updateArticle');

        Route::get('/createArticle', 'ArticleController@create')->name('createArticle');
        Route::post('/storeArticle', 'ArticleController@store')->name('storeArticle');
        Route::delete('/{article_id}/deleteArticle', 'ArticleController@destroy')->name('deleteArticle');

        // Article assignment
        Route::post('/{user_id}/updateAssignment', 'ArticleAssignmentController@assign');
    });
});
