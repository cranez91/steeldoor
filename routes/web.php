<?php

use App\Http\Controllers\HomeController;

Route::get('/job-opportunities', [HomeController::class, 'jobOpportunities'])->name('job-opportunities.index');
Route::get('/job-opportunities/{slug}', [HomeController::class, 'showJobOpportunity'])->name('job-opportunities.show');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.job-opportunity.dashboard');
    Route::get('/job-opportunity/create', [HomeController::class, 'createOpportunity'])->name('admin.job-opportunity.create');
    Route::get('/job-opportunity/{slug}/edit', [HomeController::class, 'editOpportunity'])->name('admin.job-opportunity.edit');
    Route::get('/job-opportunity/{slug}/applicants', [HomeController::class, 'applicants'])->name('admin.job-opportunity.applicants');
});

Route::get('/storage/resumes/{filename}', function ($filename) {
    $path = storage_path('app/resumes/' . $filename);
    if (!File::exists($path)) { abort(404); }
    return response()->download($path, $filename);
})->where('filename', '.*');

Route::redirect('/', '/job-opportunities');