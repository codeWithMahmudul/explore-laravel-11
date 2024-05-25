<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});


// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});
// Create
Route::get('jobs/create', function (){
    return view('jobs.create');
});
// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', compact('job'));
});
// Store
Route::post('/jobs', function (){
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ], [
        'title.required' => 'Job title is required',
        'salary.required' => 'Job salary is required',
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});
// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', compact('job'));
});
// Update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ], [
        'title.required' => 'Job title is required',
        'salary.required' => 'Job salary is required',
    ]);

    //    Authorize

    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    return redirect('/jobs/'. $job->id);
});
// Destroy
Route::delete('/jobs/{id}', function ($id) {
//  Authorize
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
