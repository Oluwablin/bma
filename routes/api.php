<?php

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
//NON-AUTHETICATED USERS

//REGISTER
Route::post('user/register', 									        'RegistrationController@registerUser');

//LOGIN
Route::post('user/login', 										        'AuthenticationController@loginUser');

//RESET
Route::post('send/password/email',                                      'AuthenticationController@forgotPassword');
Route::post('send/password/reset',                                      'AuthenticationController@resetPassword');


//AUTHETICATED USERS
Route::middleware('jwt.auth')->group(function () {
    Route::get('get/authenticated/user', 							    'AuthenticationController@userCurrentlyLoggedIn');
    Route::post('user/logout', 										    'AuthenticationController@logoutUser');

    //QUESTIONS
    Route::get('fetch/list/of/all/questions',                           'QuestionController@listAllQuestions');
    Route::get('fetch/a/question/{ref}',                                'QuestionController@showQuestion');
    Route::get('fetch/questions/by/category',                           'QuestionController@fetchQuestionByCategory');
    Route::put('update/a/question/{ref}',                               'QuestionController@updateQuestion');
    Route::delete('delete/a/question/{ref}',                            'QuestionController@destroyQuestion');
    Route::post('create/new/question',                                  'QuestionController@createQuestion');
    Route::post('import/new/question',                                  'QuestionController@import');

    //CHOICES
    Route::post('create/new/choice',                                    'ChoiceController@createChoice');
    Route::put('update/a/choice/{ref}',                                 'ChoiceController@updateChoice');
    Route::delete('delete/a/choice/{ref}',                              'ChoiceController@destroyChoice');

});
