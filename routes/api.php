<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobOpportunityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function () {
    Route::post('/job-opportunities/apply', [JobOpportunityController::class, 'applyToJob'])->name('job-opportunities.apply');
    Route::get('/dashboard', [JobOpportunityController::class, 'adminDashboard']);
    Route::get('/job-opportunity/{slug}', [JobOpportunityController::class, 'show']);
    Route::post('/job-opportunity', [JobOpportunityController::class, 'store'])->name('admin.job-opportunity.store');
    Route::get('/job-opportunity/{slug}/applicants', [JobOpportunityController::class, 'applicants'])->name('admin.job-opportunity.applicants');
    Route::put('/job-opportunity/{slug}', [JobOpportunityController::class, 'update'])->name('admin.job-opportunity.update');
    Route::delete('/job-opportunity/{slug}', [JobOpportunityController::class, 'destroy'])->name('admin.job-opportunity.destroy');
});
Route::prefix('seeker')->group(function () {
    Route::get('/job-opportunities', [JobOpportunityController::class, 'jobOpportunities']);
});