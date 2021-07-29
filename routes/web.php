<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->namespace('Admin')->group(function () {
    //Especialidades
    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/specialties/create', 'SpecialtyController@create'); // formulario de registro
    Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
    Route::post('/specialties', 'SpecialtyController@store');// envio del form
    Route::put('/specialties/{specialty}', 'SpecialtyController@update');
    Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

    //DOCTOR
    Route::resource('doctors', 'DoctorController');

    //PACIENTE
    Route::resource('patients', 'PatientController');
});


Route::middleware(['auth','doctor'])->namespace('Doctor')->group(function () {
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');
});



