<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
Route::get('/dashboard', [ProjectController::class, 'viewProjects'])->name('dashboard');
Route::get('/projects/{project}/employees', [ProjectController::class, 'showProjectEmployees'])->name('project.employees');
Route::get('search-employees', [EmployeeController::class, 'searchEmployees'])->name('search-employees');
Route::get('search-clients', [ClientController::class, 'searchClients'])->name('search-clients');
Route::get('search-projects', [ProjectController::class, 'searchProjects'])->name('search-projects');
Route::get('/changelog', function () {
    return view('changelog');
})->name('changelog');
Route::get('/request-administration', [UserController::class, 'showRequestAdminForm'])->name('request-administration');
Route::get('/client-list', [ClientController::class, 'showClients'])->name('client.list');
Route::get('/employee-list', [EmployeeController::class, 'showEmployees'])->name('employee.list');
Route::get('/generate-pdf', [ProjectController::class, 'generateHtmlToPDF'])->name('pdf.download');

});


Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('client/create', [ClientController::class, 'create'])->name('client.create');
Route::post('client', [ClientController::class, 'store'])->name('client.store');
Route::get('clients', [ClientController::class, 'getClients'])->name('client.view');
Route::get('addproject', [ProjectController::class, 'form'])->name('add.project');
Route::get('/add-employees', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/add-employees', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('/store-project', [ProjectController::class, 'store'])->name('store-project');
Route::get('update-status/{id}', [ProjectController::class, 'showUpdateStatusForm'])->name('show-update-status-form');
Route::patch('update-status/{id}', [ProjectController::class, 'updateStatus'])->name('update-status');
Route::put('/projects/{id}/update-publish', [ProjectController::class, 'updatePublish'])->name('update-publish');

});


