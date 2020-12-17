<?php

namespace App\Http\Controllers;

use App\Models\JobShift;
use Illuminate\Http\Request;

class JobShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = trans('All Job Shifts');

        $jobShifts = JobShift::all();

        return view('job_shifts.index', [
            'pageTitle' => $pageTitle,
            'jobShifts' => $jobShifts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans('Add Job Shift');

        return view('job_shifts.create')->with('pageTitle', $pageTitle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JobShift::create($request->except('_token'));

        return back()->with('success', 'Job shift was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobShift  $jobShift
     * @return \Illuminate\Http\Response
     */
    public function show(JobShift $jobShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobShift  $jobShift
     * @return \Illuminate\Http\Response
     */
    public function edit(JobShift $jobShift)
    {
        $pageTitle = trans('Edit Job Shift');

        return view('job_shifts.edit', [
            'pageTitle' => $pageTitle,
            'jobShift'  => $jobShift,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobShift  $jobShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobShift $jobShift)
    {
        $jobShift->update($request->except('_token'));

        return back()->with('success', 'Job shift was updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobShift  $jobShift
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobShift $jobShift)
    {
        $jobShift->delete();

        return response('Success', 200);
    }
}
