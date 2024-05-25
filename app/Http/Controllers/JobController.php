<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    function index(){
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }
    function create()
    {
        return view('jobs.create');
    }
    function show(Job $job){
        return view('jobs.show', ['job' => $job]);
    }
    function store(Request $request){
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
    }
    function edit(Job $job){
        return view('jobs.edit', compact('job'));
    }
    function update(Job $job){
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ], [
            'title.required' => 'Job title is required',
            'salary.required' => 'Job salary is required',
        ]);

        //    Authorize

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        return redirect('/jobs/'. $job->id);
    }
    function destroy(Job $job){
        $job->delete();
        return redirect('/jobs');
    }
}
