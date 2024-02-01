<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\View\SocialController;
use App\Http\Controllers\User\View\UserController;
use App\Http\Controllers\User\View\UserDetailController;
use App\Http\Controllers\Geo\View\ProvinceController;
use App\Http\Controllers\Geo\View\CityController;
use App\Http\Controllers\Tickets\View\TicketController;
use App\Http\Controllers\Notifications\View\NotificationController;

use App\Http\Controllers\Production\View\MachineController;
use App\Http\Controllers\Production\View\MachineDataController;
use App\Http\Controllers\Production\View\WorkController;
use App\Http\Controllers\Production\View\SyncController;
use App\Http\Controllers\Production\View\MachineLogController;
use App\Http\Controllers\Production\View\ScheduleController;
use App\Http\Controllers\Commercial\View\OrderController;
use App\Http\Controllers\Commercial\View\OrderLotController;

use App\Http\Controllers\Production\View\MachineManteinanceController;

use App\Http\Controllers\Maps\View\LeafletController;

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

Route::get('cronjob', [SyncController::class, 'cronJob']);

Route::get('invitation/deny/{uuid}', [InvitationController::class, 'denyInvitation']);
Route::post('invitation/confirm', [InvitationController::class, 'confirmInvitation'])->name('confirm.invitation');
//-------------socialite------------------------
Route::get('login/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::post('locale/{locale}', [LocaleController::class,'locale'])->name('locale');
//------------------routes auth - verified ----------------------------------------------
Route::group(['middleware' => ['auth','verified']], function(){
    Route::get('start',[HomeController::class, 'Start'] );
    Route::get('geo/nations/provinces/{nation_id}',[ProvinceController::class, 'getProvincesByNation']);
    Route::get('geo/provinces/cities/{province_id}',[CityController::class, 'getCitiesByProvince']);
    Route::get('form-user-details',[UserDetailController::class, 'loadForm'])->name('user.detail.form');
    Route::post('userdetails',[UserDetailController::class, 'store'])->name('user.detail.store');
});
//------------------routes auth - verified - profiled----------------------------------------------
Route::group(['middleware' => ['auth','verified','profiled']], function(){
    Route::get('/phone-check', [HomeController::class, 'phoneCheck'])->name('phone-check');
    Route::post('/phone-verify', [HomeController::class, 'phoneCodeVerify'])->name('phone-verify');
    Route::post('/phone-sendcode', [HomeController::class, 'phoneSendCode'])->name('phone-sendcode');
    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    Route::view('/profile/password', 'profile.password')->name('profile.password');
    Route::post('/profile/image', [UserController::class, 'updateUserImage'])->name('profile.image');
    Route::get('userdetails/edit/{id}',[UserDetailController::class, 'edit'])->name('user.detail.edit');
    Route::put('userdetails/update/{id}',[UserDetailController::class, 'update'])->name('user.detail.update');
});
//------------------routes auth - verified - profiled - phone_verified ----------------------------------------------
Route::group(['middleware' => ['auth','verified','profiled']], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::view('/two-factor-auth/', 'auth.two-factor-auth')->name('2fa-settings')->middleware(['password.confirm']);
    Route::resource('roles','App\Http\Controllers\Role\View\RoleController');
    Route::resource('permissions','App\Http\Controllers\Permission\View\PermissionController');
    //------------------Users-------------------------------
    Route::resource('users','App\Http\Controllers\User\View\UserController');
    Route::post('allusers',[UserController::class, 'allUsers'])->name('allusers');
    //------------------User Details-------------------------------
    Route::get('userdetails/copy/{id}',[UserDetailController::class, 'copy'])->name('user.detail.copy');
    Route::delete('userdetails/{id}',[UserDetailController::class, 'destroy'])->name('user.detail.delete');
    //------------------Geo-------------------------------
    Route::resource('nations','App\Http\Controllers\Geo\View\NationController');
    Route::resource('provinces','App\Http\Controllers\Geo\View\ProvinceController');
    Route::resource('cities','App\Http\Controllers\Geo\View\CityController');
    Route::post('allcities',[CityController::class, 'allCities'])->name('allcities');
    //-------------------Notifications-----------------------------
    Route::get('my-notifications', [NotificationController::class, 'myNotifications'])->name('my.notifications');
    Route::get('notification-center', [NotificationController::class, 'notificationCenter'])->name('notification.center');
    Route::post('notification-asRead',[NotificationController::class, 'markAsRead'])->name('notification.asRead');
    //-------------------Production-----------------------------
    Route::resource('builders', 'App\Http\Controllers\Production\View\BuilderController');
    Route::resource('providers', 'App\Http\Controllers\Production\View\ProviderController');
    Route::resource('machine-types', 'App\Http\Controllers\Production\View\MachineTypeController');
    //Lots
    Route::resource('lots', 'App\Http\Controllers\Commercial\View\OrderLotController');
    Route::post('alllots',[OrderLotController::class, 'allOrderLots'])->name('alllots');
    //Syncs
    Route::resource('syncs', 'App\Http\Controllers\Production\View\SyncController');
    Route::post('allsyncs',[SyncController::class, 'allSyncs'])->name('allsyncs');
    Route::post('sync/detail', [SyncController::class, 'getSyncDetail'])->name('sync.details');

    //Log / Diagnostic
    Route::resource('diagnostics', 'App\Http\Controllers\Production\View\MachineLogController');
    Route::post('alldiagnostics',[MachineLogController::class, 'allDiagnostics'])->name('alldiagnostics');
    Route::post('diagnostic/detail', [MachineLogController::class, 'getDiagnosticDetail'])->name('diagnostic.details');

    //machines
    Route::resource('machines', 'App\Http\Controllers\Production\View\MachineController');
    Route::post('machine/sync', [MachineController::class, 'syncMachine'])->name('machine.sync');
    Route::post('machine/sync-diagnostics', [MachineController::class, 'syncMachineDiagnostics'])->name('machine.sync.diagnostics');

    Route::post('machine/data', [MachineController::class, 'getMachineData'])->name('machine.data');
    Route::post('machine/data/detail', [MachineDataController::class, 'getTelemetryDetail'])->name('machine.data.details');

    //content of machine show
    Route::post('machine/works', [MachineController::class, 'getMachineWorks'])->name('machine.show.works');
    Route::post('machine/allworks',[MachineController::class, 'allMachineWorks'])->name('machine.allworks');
    Route::post('machine/syncs',[MachineController::class, 'getMachineSyncs'])->name('machine.show.syncs');
    Route::post('machine/allsyncs',[MachineController::class, 'allMachineSyncs'])->name('machine.allsyncs');
    Route::post('machine/diagnostics',[MachineController::class, 'getMachineDiagnostics'])->name('machine.show.diagnostics');
    Route::post('machine/alldiagnostics',[MachineController::class, 'allMachineDiagnostics'])->name('machine.alldiagnostics');
    Route::post('machine/schedule',[MachineController::class, 'viewMachineSchedule'])->name('machine.show.schedule');
    Route::post('machine/saveschedule',[MachineController::class, 'setMachineSchedule'])->name('machine.save.schedule');
    Route::post('machine/ping',[MachineController::class, 'pingMachine'])->name('machine.ping');
    Route::post('machines/syncs',[MachineController::class, 'forceMachinesSyncs'])->name('machines.force.syncs');

    Route::post('machine/telemetry',[MachineController::class, 'getMachineTelemetry'])->name('machine.show.telemetry');
    Route::post('machine/alltelemetry',[MachineController::class, 'allMachineTelemetry'])->name('machine.show.alltelemetry');
    Route::post('machine/orders', [MachineController::class, 'getMachineOrders'])->name('machine.show.orders');
    Route::post('machine/allorders',[MachineController::class, 'allMachineOrders'])->name('machine.allorders');
    Route::post('machine/manteinances',[MachineController::class, 'getMachineManteinances'])->name('machine.show.manteinances');
    Route::post('machine/allmanteinances',[MachineController::class, 'allMachineManteinances'])->name('machine.allmanteinances');
    Route::post('machine/attachments',[MachineController::class, 'getMachineAttachments'])->name('machine.show.attachments');
    Route::post('machine/attachment/save',[MachineController::class, 'saveMachineAttachment'])->name('machine.attachment.save');

    Route::post('machine/map',[MachineController::class, 'getMachineMap'])->name('machine.map');
    //Manteinances
    Route::resource('manteinance-types', 'App\Http\Controllers\Production\View\MachineManteinanceTypeController');
    Route::resource('manteinances', 'App\Http\Controllers\Production\View\MachineManteinanceController');
    Route::post('allmanteinances',[MachineManteinanceController::class, 'allManteinances'])->name('allmanteinances');
    Route::post('manteinance/status/{uuid}/change', [MachineManteinanceController::class, 'changeStatus'])->name('manteinance.status.change');

    //works
    Route::get('works', [WorkController::class, 'index'])->name('works.index');
    Route::get('works/create', [WorkController::class, 'create'])->name('works.create');
    Route::post('works/store', [WorkController::class, 'store'])->name('works.store');
    Route::get('work/{uuid}', [WorkController::class, 'edit'])->name('works.edit');
    Route::post('allworks',[WorkController::class, 'allWorks'])->name('allworks');
    Route::get('works/{uuid}/show', [WorkController::class, 'show'])->name('works.show');
    Route::post('work/detail', [WorkController::class, 'getWorkDetail'])->name('work.details');

	Route::delete('work/{uuid}/destroy', [WorkController::class, 'destroy'])->name('works.destroy');

    Route::resource('programs','App\Http\Controllers\Production\View\ProgramController');
    //Schedules
    Route::resource('schedules', 'App\Http\Controllers\Production\View\ScheduleController');
    Route::post('allschedules',[ScheduleController::class, 'allSchedules'])->name('allschedules');
    Route::post('schedule/detail', [ScheduleController::class, 'getScheduleDetail'])->name('schedule.details');
    //Commercial
    Route::resource('orders', 'App\Http\Controllers\Commercial\View\OrderController');
    Route::post('allorders',[OrderController::class, 'allOrders'])->name('allorders');
    Route::post('order/{uuid}/addlog',[OrderController::class, 'addLog'])->name('order.add.log');
    Route::post('order/{uuid}/attachment/save', [OrderController::class, 'saveAttachment'])->name('order.attachment.save');
    Route::delete('order/{uuid}/attachment/delete', [OrderController::class, 'deleteAttachment'])->name('order.attachment.delete');
    Route::get('order/searchbycode', [OrderController::class, 'getOrderByCode'])->name('order.search.by.code');

    //localizations
    Route::get('telemetries', [MachineDataController::class, 'index'])->name('telemetries.index');
    Route::get('telemetries/{uuid}', [MachineDataController::class, 'show'])->name('telemetries.show');
    Route::post('alltelemetries',[MachineDataController::class, 'allTelemetries'])->name('alltelemetries');


    //-------------------test-----------------------------
    Route::get('test',[TestController::class, 'test']);
    Route::post('test_post',[TestController::class, 'test_post'])->name('test.post');

    //---------------leaflet map------------------------------------
    Route::get('leaflet', [LeafletController::class, 'index']);
});

Route::group(['middleware' => ['role:admin']], function () {
});
