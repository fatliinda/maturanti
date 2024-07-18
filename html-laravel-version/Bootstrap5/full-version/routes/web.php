<?php

// routes/web.php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Crm;
use App\Http\Controllers\language\LanguageController;

use App\Http\Controllers\apps\EcommerceProductAdd;
use App\Http\Controllers\apps\AcademyDashboard;
use App\Http\Controllers\apps\AcademyCourse;
use App\Http\Controllers\apps\AcademyCourseDetails;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\pages\UserConnections;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\LoginCover;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\RegisterCover;
use App\Http\Controllers\authentications\RegisterMultiSteps;
use App\Http\Controllers\authentications\VerifyEmailBasic;
use App\Http\Controllers\authentications\VerifyEmailCover;
use App\Http\Controllers\authentications\ResetPasswordBasic;
use App\Http\Controllers\authentications\ResetPasswordCover;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\ForgotPasswordCover;
use App\Http\Controllers\authentications\TwoStepsBasic;
use App\Http\Controllers\authentications\TwoStepsCover;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\charts\ChartJs;

// Main Page Route
Route::get('/', [AcademyDashboard::class, 'index'])->name('app-academy-dashboard');
// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// layout;


// apps
Route::get('/app/ecommerce/product/add', [EcommerceProductAdd::class, 'index'])->name('app-ecommerce-product-add');
Route::get('/app/academy/course', [AcademyCourse::class, 'index'])->name('app-academy-course');
Route::get('/app/academy/course-details/{id}', [AcademyCourseDetails::class, 'index'])->name('app-academy-course-details');
Route::post('/courses/{id}/submit', [AcademyCourseDetails::class, 'submitAnswer'])->name('submitAnswer');

// pages
Route::get('/pages/profile-user', [UserProfile::class, 'index'])->name('pages-profile-user');
Route::get('/pages/profile-connections', [UserConnections::class, 'index'])->name('pages-profile-connections');


// authentication
Route::post('/auth/login', [LoginBasic::class, 'login'])->name('loginuser');
Route::get('/login', [LoginBasic::class, 'index'])->name('login');
Route::get('/auth/login-cover', [LoginCover::class, 'index'])->name('auth-login-cover');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/register-cover', [RegisterCover::class, 'index'])->name('auth-register-cover');
Route::post('/register', [RegisterBasic::class, 'store'])->name('store');
Route::get('/auth/register-multisteps', [RegisterMultiSteps::class, 'index'])->name('auth-register-multisteps');
Route::get('/auth/verify-email-basic', [VerifyEmailBasic::class, 'index'])->name('auth-verify-email-basic');
Route::get('/auth/verify-email-cover', [VerifyEmailCover::class, 'index'])->name('auth-verify-email-cover');
Route::get('/auth/reset-password-basic', [ResetPasswordBasic::class, 'index'])->name('auth-reset-password-basici');
Route::get('/auth/reset-password-cover', [ResetPasswordCover::class, 'index'])->name('auth-reset-password-cover');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/auth/forgot-password-cover', [ForgotPasswordCover::class, 'index'])->name('auth-forgot-password-cover');
Route::get('/auth/two-steps-basic', [TwoStepsBasic::class, 'index'])->name('auth-two-steps-basic');
Route::get('/auth/two-steps-cover', [TwoStepsCover::class, 'index'])->name('auth-two-steps-cover');

// laravel example
Route::get('/laravel/user-management', [UserManagement::class, 'UserManagement'])->name('laravel-example-user-management');
Route::resource('/user-list', UserManagement::class);
Route::get('/charts/chartjs', [ChartJs::class, 'index'])->name('charts-chartjs');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [AcademyDashboard::class, 'index'])->name('app-academy-dashboard');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/app/ecommerce/product/add', [EcommerceProductAdd::class, 'index'])->name('app-ecommerce-product-add');
});