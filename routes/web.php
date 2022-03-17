<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/home', [StudentController::class, 'index'])->name('home');
// Route::get('/student/create', 'StudentController@create')->name('student.create');
// Route::post('/student/store', 'StudentController@store')->name('student.store');
// Route::get('/student/{student}/edit', 'StudentController@edit')->name('student.edit');
// Route::put('/student/{student}', 'StudentController@update')->name('student.update');
// Route::delete('/student/{student}', 'StudentController@destroy')->name('student.destroy');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('backend.home');
    })->name('home');

    Route::resource('roles', RoleController::class);
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');

    // Student
    Route::get('students/export/', [StudentController::class, 'export'])->name('students.export');
    Route::get('students/pdf/', [StudentController::class, 'downloadPdf'])->name('students.pdf');
    Route::get('/trashed-students', [StudentController::class, 'trash'])
        ->name('students.trashed');
    Route::get('/trashed-students/{student}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::delete('/trashed-students/{student}/delete', [StudentController::class, 'delete'])->name('students.delete');
    Route::resource('students', StudentController::class);

    Route::resource('users', UserController::class);

    Route::get('/trashed-users', [UserController::class, 'trash'])
        ->name('users.trashed');
    Route::get('/trashed-users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/trashed-users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/users/edit-profile', [ProfileController::class, 'edit'])->name('users.profile.edit');

    Route::patch('/users/update-profile', [ProfileController::class, 'update'])->name('users.profile.update');



    // Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('teachers', TeacherController::class);

    // Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
});
