<?php

use App\Http\Controllers\adminrController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ForgetpasswordController;
use App\Http\Controllers\OrganisateurController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});
Route::get('/ajouter', function () {
    return view('Admin.Ajouterevent');
});
Route::get('/login',[AuthentificationController::class,'pagelogin'])->name('login');

Route::post('/login',[AuthentificationController::class,'loginAction'])->name('loginAction');
Route::get('/register',[AuthentificationController::class, 'pageregister'])->name('pageregister');

Route::post('/register.save',[AuthentificationController::class, 'registerSave'])->name('register.save');
Route::post('/', [AuthentificationController::class, 'destroy'])->name('logout');
Route::get('/forget_password', [ForgetpasswordController::class, 'fogetpassword'])->name('foget.password');
Route::post('/forget_password', [ForgetpasswordController::class, 'fogetpasswordPost'])->name('foget.passwordPost');
Route::get('/rest_password/{token}', [ForgetpasswordController::class, 'rest_password'])->name('rest.password');
Route::post('/rest_password', [ForgetpasswordController::class, 'rest_passwordPost'])->name('rest.passwordPost');
/*-------------------------------------------------Admin*-------------------------------------------------------------*/
Route::get('/admin/dashbord',[adminrController::class, 'index'])->name('admin.dashbord');




/*----------------------------                 Oraganisateur                                        ----------------*/
Route::get('/organisateur/dashbord',[OrganisateurController::class, 'index'])->name('org.dashbord');
