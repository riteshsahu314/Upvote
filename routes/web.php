<?php

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


Route::get('/', 'TopQuestionsController@index')->name('top_questions');

Auth::routes(['verify' => true]);

// Questions
Route::get('/questions', 'QuestionsController@index')->name('questions.index');
Route::post('/questions', 'QuestionsController@store')->name('questions.store');
Route::get('/questions/create', 'QuestionsController@create')->name('questions.create');
Route::get('/questions/{question}', 'QuestionsController@show')->name('questions.show');
Route::patch('/questions/{question}', 'QuestionsController@update')->name('questions.update');
Route::delete('/questions/{question}', 'QuestionsController@destroy')->name('questions.destroy');

// Search Questions
Route::get('/search', 'SearchController@show')->name('search');

// Answers
Route::get('/questions/{question}/answers', 'AnswersController@index');
Route::post('/questions/{question}/answers', 'AnswersController@store');
Route::delete('/answers/{answer}', 'AnswersController@destroy');
Route::patch('/answers/{answer}', 'AnswersController@update');
Route::post('/answers/{answer}/best', 'AnswersController@best');

// Comments
Route::post('/questions/{question}/comments', 'QuestionCommentsController@store')->middleware(['auth', 'verified']);
Route::delete('/questions/{question}/comments/{comment}', 'QuestionCommentsController@destroy')->middleware(['auth', 'verified']);

Route::post('/answers/{answer}/comments', 'AnswerCommentsController@store')->middleware(['auth', 'verified']);
Route::delete('/answers/{answer}/comments/{comment}', 'AnswerCommentsController@destroy')->middleware(['auth', 'verified']);

// Users
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');

// Users Avatar
Route::post('/users/{user}/avatar', 'UserAvatarController@store')->middleware('auth')->name('avatar');

// Tags
Route::get('/tags', 'TagsController@index')->name('tags.index');
Route::get('/tags/{tag}', 'TagsController@show')->name('tags.show');

// Notifications
Route::get('/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

// Favorites
Route::post('/questions/{question}/favorites', 'FavoritesController@store');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy');

// Question Votes
Route::post('/questions/{question}/{type}', 'QuestionVotesController@store')->name('questions.votes.store');

// Answer Votes
Route::post('/answers/{answer}/{type}', 'AnswerVotesController@store')->name('answers.votes.store');

// Social Login
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');
