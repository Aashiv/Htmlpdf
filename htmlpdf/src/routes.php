<?php
Route::group(['middleware' => ['web']], function(){
   
	Route::resource('/task', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController');

	Route::get('/', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@index');
	Route::get('/login', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@login');
	Route::post('/dologin', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@doLogin')->name('dologin');
	Route::get('/logout', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@logout');

	Route::get('/doworkspace/{id}', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@dashboard');
	Route::post('/getColumnHtmlData', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@getColumnHtmlData');
	Route::post('/saveColumnHtmlData', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@saveColumnHtmlData');
	Route::get('/tcpdf_gen/{id}', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@tcpdf_gen');

	Route::post('/createTableRequest', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@createTableRequest');
	Route::post('/donewproject', 'Aashiv\Htmlpdf\Controllers\HtmlpdfController@doNewProject')->name('donewproject');
});