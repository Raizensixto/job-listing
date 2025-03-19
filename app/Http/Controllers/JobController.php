<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index() {

        $jobs = Job::with('employer')->latest()->Paginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create() {
        return view('jobs.create');
    }

    public function show(Job $job) {
        
        return view('jobs.show', ['job' => $job]);
    }

    public function store() {
         // validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $job = Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => Auth::id()
    ]);

    // Mail::to($job->employer->user)->queue(
    //     new JobPosted($job)
    // );

    return redirect('/jobs');
    }

    public function edit(Job $job) {

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job) {
        // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (on hold...)
    // update the job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    // redirect to the job page
    return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job) {
           // authorize

    // delete the job
    $job->delete();
    
    // redirect
    return redirect('/jobs');
    }
}
