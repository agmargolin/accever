<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = '<img src="images/buratino.png" />';
	return AdminSection::view($content, 'AccEver');
}]);
/*
Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);*/

Route::get('setLog', '\App\Http\Controllers\LogController@add');

Route::get('editpatient/{patientId}', 'MyController@index');