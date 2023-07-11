<?php

use App\Http\Controllers\JobOpportunityController;

Route::get('/admin/dashboard', [JobOpportunityController::class, 'adminDashboard']);
Route::get('/admin/job-opportunities', [JobOpportunityController::class, 'adminJobOpportunities']);
Route::get('/job-opportunities', [JobOpportunityController::class, 'jobOpportunities'])->name('job-opportunities.index');
Route::get('/job-opportunities/{slug}', [JobOpportunityController::class, 'showJobOpportunity'])->name('job-opportunities.show');
Route::post('/job-opportunities/apply', [JobOpportunityController::class, 'applyToJob'])->name('job-opportunities.apply');

Route::get('job-opportunities/create', [JobOpportunityController::class, 'create'])->name('admin.job-opportunities.create');
Route::post('job-opportunities', [JobOpportunityController::class, 'store'])->name('admin.job-opportunities.store');
Route::get('job-opportunities/{jobOpportunity}/edit', [JobOpportunityController::class, 'edit'])->name('admin.job-opportunities.edit');
Route::put('job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'update'])->name('admin.job-opportunities.update');

Route::redirect('/', '/job-opportunities');