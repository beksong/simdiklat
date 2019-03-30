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
// training route for admin to get all participants start here
Route::get('traininglist','TrainingController@traininglist')->name('trainingslist');
// admin get all registered participant
Route::get('training/showparticipants/{training_id}','TrainingController@showparticipants')->name('showparticipants');
// ajax datatables for admin to get all opened trainings
Route::get('getregisteredparticipants','TrainingController@getregisteredparticipants')->name('getregisteredparticipants');
// ajax datatables for admin to get all regsitered participants
Route::get('getalreadyregisteredparticipants','TrainingController@getalreadyregisteredparticipants')->name('getalreadyregisteredparticipants');
// ajax datatables trainings
Route::get('gettrainings','TrainingController@getTrainings')->name('gettrainings');
// ajax request when user type training name on select2
Route::get('gettraininglist','TrainingController@gettraininglist')->name('gettraininglist');
/**
 * here is where admin wanna enrole or giving role a participant to custom training
 * update participant from one training to others
 * or delete participant from training that he/she has been register
 */
Route::put('training/updateparticipantbyadmin','TrainingController@updateparticipantbyadmin')->name('updateparticipantbyadmin');
Route::delete('training/deleteparticipantbyadmin','TrainingController@deleteparticipantbyadmin')->name('deleteparticipantbyadmin');
/**
 * here is admin print participant and create absent on pdf
 */
Route::get('training/printparticipants/{training_id}','TrainingController@printparticipantsbyadmin')->name('printparticipantsbyadmin');
// schedules masters
Route::get('schedules','ScheduleController@index')->name('schedules');
Route::get('schedules/{id}','ScheduleController@getScheduleByTrainingId')->name('getschedulebytrainingid');
Route::post('schedules','ScheduleController@store')->name('schedules');
Route::put('schedules','ScheduleController@update')->name('schedules');
Route::delete('schedules','ScheduleController@delete')->name('schedules');
// ajax datatables masterschedules
Route::get('getschedules','ScheduleController@getschedulemasters')->name('getschedules');

// schedules details
Route::get('schedules/detailschedules/{type}/{mschedule_id}','ScheduleController@indexdetail')->name('detailschedules');
Route::post('schedules/detailschedules','ScheduleController@savedetail')->name('savedetailschedule');
Route::put('schedules/updateschedules','ScheduleController@updatedetail')->name('updatedetailschedule');
Route::delete('schedules/deleteschedules','ScheduleController@deletedetail')->name('deletedetailschedule');

// cetak detailschedules
Route::get('schedules/detailschedules/print/{type}/{mschedule_id}','ScheduleController@printdetailschedule')->name('printdetailschedule');
// ajax datatables detailschedules
Route::get('getdetailschedules','ScheduleController@getdetailschedules')->name('getdetailschedules');

// open registration training
Route::get('training/openregistration','TrainingRegistrationController@index')->name('opentraining');
Route::get('training/getopenregistration','TrainingRegistrationController@getTrainingsForRegistration')->name('getopenregistration');
Route::get('training/register/{trainingslug}/{training_id}','TrainingRegistrationController@register')->name('registertraining');
Route::post('training/register','TrainingRegistrationController@store')->name('registertraining');
Route::put('training/register','TrainingRegistrationController@update')->name('registertraining');

// training that users as participant
Route::get('training/asparticipant','TrainingRegistrationController@asparticipant')->name('asparticipant');
// history of participant
Route::get('participant-history','TrainingRegistrationController@participanthistory')->name('participant-history');
// ajax datatables to get history training of participant
Route::get('getparticipanthistory','TrainingRegistrationController@getparticipanthistory')->name('getparticipanthistory');
// print registration
Route::get('training/printregistration/{id}','TrainingRegistrationController@printregistration')->name('printregistration');