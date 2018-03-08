<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'reporter', 'prefix' => 'report'], function () {
    
    // report routes
    Route::get('/', 'ReportController@index')->name('report-list');

    Route::get('/create', 'ReportController@create')->name('report-create');
    
    Route::post('/create', 'ReportController@save');
    
    Route::get('/edit/{id}', 'ReportController@edit')->name('report-edit');
    
    Route::post('/edit/{id}', 'ReportController@update');
    
    Route::delete('/delete/{id}', 'ReportController@delete')->name('report-del');
    
    Route::get('/preview/{id}', 'ReportController@preview')->name('report-preview');
    
    Route::get('/gen/{id}', 'ReportController@generate')->name('report-gen');
    
    Route::get('/approve/{id}', 'ReportController@approve')->name('report-approve');
    
});



Route::group(['middleware' => 'reporter', 'prefix' => 'report/{report}/issue'], function () {
    
    // report's issue routes
    Route::get('/', 'IssueController@index')->name('issue-list');

    Route::get('/create', 'IssueController@create')->name('issue-create');
    
    Route::post('/create', 'IssueController@save');
    
    Route::get('/edit/{id}', 'IssueController@edit')->name('issue-edit');
    
    Route::post('/edit/{id}', 'IssueController@update');
    
    Route::delete('/delete/{id}', 'IssueController@delete')->name('issue-del');
    
});



Route::group(['middleware' => 'reporter', 'prefix' => 'report/{report}/issue/{issue}/screenshot'], function () {
    
    // report's issue's screenshots routes
    Route::get('/', 'ScreenshotController@index')->name('screenshot-list');

    Route::get('/create', 'ScreenshotController@create')->name('screenshot-create');
    
    Route::post('/create', 'ScreenshotController@save');
    
    Route::get('/edit/{id}', 'ScreenshotController@edit')->name('screenshot-edit');
    
    Route::post('/edit/{id}', 'ScreenshotController@update');
    
    Route::delete('/delete/{id}', 'ScreenshotController@delete')->name('screenshot-del');
    
});




Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    
    // vulnerability routes
    Route::get('/vulnerability', 'VulnerabilityController@index')->name('vulnerability-list');

    Route::get('/vulnerability/create', 'VulnerabilityController@create')->name('vulnerability-create');
    
    Route::post('/vulnerability/create', 'VulnerabilityController@save');
    
    Route::get('/vulnerability/edit/{id}', 'VulnerabilityController@edit')->name('vulnerability-edit');
    
    Route::post('/vulnerability/edit/{id}', 'VulnerabilityController@update');
    
    Route::delete('/vulnerability/delete/{id}', 'VulnerabilityController@delete')->name('vulnerability-del');
    
    // project routes
    Route::get('/projects', 'ProjectController@index')->name('project-list');

    Route::get('/project/create', 'ProjectController@create')->name('project-create');
    
    Route::post('/project/create', 'ProjectController@save');
    
    Route::get('/project/edit/{id}', 'ProjectController@edit')->name('project-edit');
    
    Route::post('/project/edit/{id}', 'ProjectController@update');
    
    Route::delete('/project/delete/{id}', 'ProjectController@delete')->name('project-del');
    
    // severity routes
    Route::get('/severities', 'SeverityController@index')->name('severity-list');

    Route::get('/severity/create', 'SeverityController@create')->name('severity-create');
    
    Route::post('/severity/create', 'SeverityController@save');
    
    Route::get('/severity/edit/{id}', 'SeverityController@edit')->name('severity-edit');
    
    Route::post('/severity/edit/{id}', 'SeverityController@update');
    
    Route::delete('/severity/delete/{id}', 'SeverityController@delete')->name('severity-del');
    
});
