<?php

use App\Http\Controllers\JobOpportunityController;

Route::get('/admin/dashboard', [JobOpportunityController::class, 'adminDashboard'])->name('admin.job-opportunity.dashboard');
Route::get('/admin/job-opportunities', [JobOpportunityController::class, 'adminJobOpportunities']);
Route::get('/job-opportunities', [JobOpportunityController::class, 'jobOpportunities'])->name('job-opportunities.index');
Route::get('/job-opportunities/{slug}', [JobOpportunityController::class, 'showJobOpportunity'])->name('job-opportunities.show');
Route::post('/job-opportunities/apply', [JobOpportunityController::class, 'applyToJob'])->name('job-opportunities.apply');

Route::get('/job-opportunity/create', [JobOpportunityController::class, 'create'])->name('admin.job-opportunity.create');
Route::post('/job-opportunity', [JobOpportunityController::class, 'store'])->name('admin.job-opportunity.store');
Route::get('/job-opportunity/{slug}/edit', [JobOpportunityController::class, 'edit'])->name('admin.job-opportunity.edit');
Route::put('/job-opportunity/{slug}', [JobOpportunityController::class, 'update'])->name('admin.job-opportunity.update');
Route::delete('/job-opportunity/{slug}', [JobOpportunityController::class, 'destroy'])->name('admin.job-opportunity.destroy');

Route::redirect('/', '/job-opportunities');