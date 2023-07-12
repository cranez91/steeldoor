<?php

use App\Http\Controllers\JobOpportunityController;

Route::get('/job-opportunities', [JobOpportunityController::class, 'jobOpportunities'])->name('job-opportunities.index');
Route::get('/job-opportunities/{slug}', [JobOpportunityController::class, 'showJobOpportunity'])->name('job-opportunities.show');
Route::post('/job-opportunities/apply', [JobOpportunityController::class, 'applyToJob'])->name('job-opportunities.apply');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [JobOpportunityController::class, 'adminDashboard'])->name('admin.job-opportunity.dashboard');
    Route::get('/job-opportunity/create', [JobOpportunityController::class, 'create'])->name('admin.job-opportunity.create');
    Route::post('/job-opportunity', [JobOpportunityController::class, 'store'])->name('admin.job-opportunity.store');
    Route::get('/job-opportunity/{slug}/edit', [JobOpportunityController::class, 'edit'])->name('admin.job-opportunity.edit');
    Route::get('/job-opportunity/{slug}/applicants', [JobOpportunityController::class, 'applicants'])->name('admin.job-opportunity.applicants');
    Route::put('/job-opportunity/{slug}', [JobOpportunityController::class, 'update'])->name('admin.job-opportunity.update');
    Route::delete('/job-opportunity/{slug}', [JobOpportunityController::class, 'destroy'])->name('admin.job-opportunity.destroy');
});

Route::get('storage/resumes/{filename}', function ($filename) {
    $path = storage_path('app/resumes/' . $filename);
    if (!File::exists($path)) { abort(404); }
    return response()->download($path, $filename);
})->where('filename', '.*');

Route::redirect('/', '/job-opportunities');