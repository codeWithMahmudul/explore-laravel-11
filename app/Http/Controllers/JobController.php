<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    function index(){
        $jobs = Job::with('employer')->simplePaginate(10);
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
//        if(Auth::user()->cannot('edit-job', $job)) {
//            dd("failure");
//        }
//        Gate::authorize('edit-job',$job);

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
