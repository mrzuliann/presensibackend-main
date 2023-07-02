<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PresensihourController;
use App\Http\Controllers\HolidaydateController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('role:1')->group(function () {
    // Auth::routes();
    // User
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-user', [App\Http\Controllers\UserController::class, 'create'])->name('user-create');
    Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
    Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update'])->name('user-update');


    Route::get('/import-user', [App\Http\Controllers\UserController::class, 'import'])->name('user-import');
    Route::get('/file-import', [UserController::class, 'importView'])->name('import-view');
    Route::post('/importuser', [UserController::class, 'import'])->name('importuser');
    Route::get('/downloadimport', [UserController::class, 'downloadfimport'])->name('downloadimport');
    Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export');
    Route::resource('user', UserController::class);
    // School
    Route::get('/import-school', [App\Http\Controllers\SchoolController::class, 'import'])->name('school-import');
    Route::get('/file-import', [SchoolController::class, 'importView'])->name('import-view');
    Route::post('/import', [SchoolController::class, 'import'])->name('import');
    Route::get('/export-schools', [SchoolController::class, 'exportSchools'])->name('exportschools');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/school', [App\Http\Controllers\SchoolController::class, 'index'])->name('school');
    Route::get('/downloadimportsekolah',[SchoolController::class, 'downloadfimport'])->name('downloadimportsekolah');
    Route::get('/create-school', [App\Http\Controllers\SchoolController::class, 'create'])->name('school-create');
    Route::post('/update-school', 'SchoolController@update')->name('school-update');
    Route::post('/store-school', [App\Http\Controllers\SchoolController::class, 'store'])->name('school-store');
    Route::resource('school', SchoolController::class);

      // Jam Presensi
      Route::get('/import-presensihour', [App\Http\Controllers\PresensihourController::class, 'import'])->name('presensihour-import');
      Route::get('/file-importjam', [PresensihourController::class, 'importView'])->name('import-view');
      Route::post('/importjam', [PresensihourController::class, 'import'])->name('importjam');
      Route::get('/export-presensihours', [PresensihourController::class, 'exportpresensihours'])->name('exportjam');

      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::get('/presensihour', [App\Http\Controllers\PresensihourController::class, 'index'])->name('presensihour');
      Route::get('/create-presensihour', [App\Http\Controllers\PresensihourController::class, 'create'])->name('presensihour-create');
      Route::post('/update-presensihour', 'PresensihourController@update')->name('presensihour-update');
      Route::post('/store-presensihour', [App\Http\Controllers\PresensihourController::class, 'store'])->name('presensihour-store');
      Route::resource('presensihour', PresensihourController::class);

      // Hari Libur
      Route::get('/import-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'import'])->name('presensiholiday-import');
      Route::get('/file-importholidays', [HolidaydateController::class, 'importView'])->name('import-view');
      Route::post('/importholidays', [HolidaydateController::class, 'import'])->name('importholidays');
      Route::get('/export-presensiholidays', [HolidaydateController::class, 'exportpresensiholidays'])->name('exportholidays');

      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::get('/presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'index'])->name('presensiholiday');
      Route::get('/downloadimportholidays',[HolidaydateController::class, 'downloadfimport'])->name('downloadimportholiday');
      Route::get('/create-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'create'])->name('presensiholiday-create');
      Route::post('/update-presensiholiday', 'HolidaydateController@update')->name('presensiholiday-update');
      Route::post('/store-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'store'])->name('presensiholiday-store');
      Route::resource('presensiholiday', HolidaydateController::class);
    // Role
    // Route::get('/import-role', [App\Http\Controllers\RoleController::class, 'import'])->name('role-import');
    // Route::get('/file-import', [RoleController::class, 'importView'])->name('import-view');
    // Route::post('/import', [RoleController::class, 'import'])->name('import');
    // Route::get('/export-roles', [RoleController::class, 'exportroles'])->name('export');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
    // Route::get('/create-role', [App\Http\Controllers\RoleController::class, 'create'])->name('role-create');
    // Route::post('/update-role', 'RoleController@update')->name('role-update');
    // Route::post('/store-role', [App\Http\Controllers\RoleController::class, 'store'])->name('role-store');
    Route::resource('role', RoleController::class);

    // Pengumuman
    Route::get('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('[pengumuman]');
    Route::get('/create-pengumuman', [App\Http\Controllers\PengumumanController::class, 'create'])->name('pengumuman-create');
    Route::post('/store-pengumuman', [App\Http\Controllers\PengumumanController::class, 'store'])->name('pengumuman-store');
    Route::resource('pengumuman', PengumumanController::class);

    // Report
    // Route::get('/import-report', [App\Http\Controllers\ReportController::class, 'import'])->name('report-import');
    // Route::get('/file-import', [ReportController::class, 'importView'])->name('import-view');
    // Route::post('/import', [ReportController::class, 'import'])->name('import');
    // Route::get('/export-reports', [ReportController::class, 'exportreports'])->name('export');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/report/perbulan', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    Route::get('/report/perhari', [App\Http\Controllers\ReportController::class, 'perhari'])->name('report.perhari');
    Route::get('/report/detail/{id}', [App\Http\Controllers\ReportController::class, 'detail'])->name('report.detail');
    Route::get('/reportpdf', [App\Http\Controllers\ReportController::class, 'report_pdf'])->name('reportpdf');
    // Route::get('/create-report', [App\Http\Controllers\ReportController::class, 'create'])->name('report-create');
    // Route::post('/update-report', 'ReportController@update')->name('report-update');
    // Route::post('/store-report', [App\Http\Controllers\ReportController::class, 'store'])->name('report-store');
    Route::resource('report', ReportController::class);

    // Galery
    // Route::get('/import-report', [App\Http\Controllers\GaleryController::class, 'import'])->name('report-import');
    // Route::get('/file-import', [GaleryController::class, 'importView'])->name('import-view');
    // Route::post('/import', [GaleryController::class, 'import'])->name('import');
    // Route::get('/export-reports', [GaleryController::class, 'exportreports'])->name('export');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/galery', [App\Http\Controllers\GaleryController::class, 'index'])->name('galery');
    // Route::get('/create-galery', [App\Http\Controllers\GaleryController::class, 'create'])->name('galery-create');
    // Route::post('/update-galery', 'GaleryController@update')->name('galery-update');
    Route::post('/store-galery', [App\Http\Controllers\GaleryController::class, 'store'])->name('galery-store');
    Route::resource('galery', GaleryController::class);

    // Reset Password
    // Route::get('/import-report', [App\Http\Controllers\ResetPasswordController::class, 'import'])->name('report-import');
    // Route::get('/file-import', [ResetPasswordController::class, 'importView'])->name('import-view');
    // Route::post('/import', [ResetPasswordController::class, 'import'])->name('import');
    // Route::get('/export-reports', [ResetPasswordController::class, 'exportreports'])->name('export');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/reset', [App\Http\Controllers\ResetPasswordController::class, 'index'])->name('reset');
    // Route::get('/create-reset', [App\Http\Controllers\ResetPasswordController::class, 'create'])->name('reset-create');
    // Route::post('/update-reset', 'ResetPasswordController@update')->name('reset-update');
    // Route::post('/store-reset', [App\Http\Controllers\ResetPasswordController::class, 'store'])->name('reset-store');
    Route::resource('reset', ResetPasswordController::class);

    Route::get('holidaydate', [HolidaydateController::class, 'getCURL'])->name('holidaydate');
    Route::get('holiday', [HolidaydateController::class, 'apiWithKey'])->name('apiWithKey');
});

// Route::middleware('role:2')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/report/perbulan', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    Route::get('/report/perhari', [App\Http\Controllers\ReportController::class, 'perhari'])->name('report.perhari');
    Route::get('/report/detail/{id}', [App\Http\Controllers\ReportController::class, 'detail'])->name('report.detail');
    Route::get('/reportpdf', [App\Http\Controllers\ReportController::class, 'report_pdf'])->name('reportpdf');
    // Route::get('/create-report', [App\Http\Controllers\ReportController::class, 'create'])->name('report-create');
    // Route::post('/update-report', 'ReportController@update')->name('report-update');
    // Route::post('/store-report', [App\Http\Controllers\ReportController::class, 'store'])->name('report-store');
    Route::resource('report', ReportController::class);
// });
