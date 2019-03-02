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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile','HomeController@profile')->name('profile');
Route::post('profile','HomeController@update')->name('updateprofile');

// lembaga penyelenggara diklat 
Route::get('lembaga','InstitutionController@index')->name('lembaga');
Route::post('lembaga','InstitutionController@save');
Route::post('lembaga/{slug}','InstitutionController@edit');
Route::delete('lembaga/{slug}','InstitutionController@delete');
// ajax
Route::get('getinstitutions','InstitutionController@getInstitutions')->name('datatableinstitutions');
Route::get('getlikeinstitution','InstitutionController@getLikeInstitution');

// PIC
Route::get('pic','PicController@index')->name('pic');
Route::post('pic','PicController@store')->name('pic');
Route::put('pic/{id}','PicController@update')->name('updatepic');
Route::delete('pic/{id}','PicController@delete')->name('deletepic');
// ajax user pic
Route::get('getpics','PicController@getPics')->name('datatablespic');
Route::get('getuser','PicController@getUser')->name('getuserselect2');

// mata diklat
Route::get('matadiklat','SubjectController@index')->name('matadiklat');
Route::post('matadiklat','SubjectController@store')->name('matadiklat');
Route::put('matadiklat','SubjectController@edit')->name('matadiklat');
Route::delete('matadiklat','SubjectController@destroy')->name('matadiklat');

//ajax matadiklat
Route::get('getmatadiklat','SubjectController@getSubjects')->name('getsubjects');
Route::get('getsubject','SubjectController@getlikesubject')->name('getlikesubject');

// speakers
Route::get('speakers','SpeakerController@index')->name('speakers');
Route::post('speakers','SpeakerController@store')->name('speakers');
Route::put('speakers','SpeakerController@edit')->name('speakers');
Route::delete('speakers','SpeakerController@destroy')->name('speakers');
// ajax datatables speakers
Route::get('getspeakers','SpeakerController@getSpeakers')->name('getspeakers');
// ajax request on selected user_id in schedule
Route::get('getspeaker','SpeakerController@getSubjectById')->name('getsubjectbyid');

//trainings
Route::get('trainings','TrainingController@index')->name('trainings');
Route::post('trainings','TrainingController@store')->name('trainings');
Route::put('trainings','TrainingController@edit')->name('trainings');
Route::delete('trainings','TrainingController@destroy')->name('trainings');
// ajax datatables trainings
Route::get('gettrainings','TrainingController@getTrainings')->name('gettrainings');

// schedules masters
Route::get('schedules','ScheduleController@index')->name('schedules');
Route::get('schedules/{id}','ScheduleController@getScheduleByTrainingId')->name('getschedulebytrainingid');
Route::post('schedules','ScheduleController@store')->name('schedules');
Route::put('schedules','ScheduleController@update')->name('schedules');
Route::delete('schedules','ScheduleController@delete')->name('schedules');
// ajax datatables masterschedules
Route::get('getschedules','ScheduleController@getschedulemasters')->name('getschedules');

// schedules details
Route::get('schedules/detailschedules/{mschedule_id}','ScheduleController@indexdetail')->name('detailschedules');
Route::post('schedules/detailschedules','ScheduleController@savedetail')->name('savedetailschedule');