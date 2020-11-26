<?php

namespace App\Http\Controllers;

use App\Models\JobLocation;
use Illuminate\Http\Request;

class JobLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = trans('All Job Locations');

        $jobLocations = JobLocation::all();

        return view('job_locations.index', [
            'pageTitle'    => $pageTitle,
            'jobLocations' => $jobLocations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans('Add Job Location');

        return view('job_locations.create')->with('pageTitle', $pageTitle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|alpha_num|min:3|max:255|unique:job_locations,name',
            'hourly_wage' => 'required|numeric|max:9999.99'
        ]);

        JobLocation::create($request->except('_token'));

        return back()->with('success', 'Job location was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobLocation  $jobLocation
     * @return \Illuminate\Http\Response
     */
    public function show(JobLocation $jobLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobLocation  $jobLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(JobLocation $jobLocation)
    {
        $pageTitle = 'Edit Job Location';

        return view('job_locations.edit', [
            'pageTitle'   => $pageTitle,
            'jobLocation' => $jobLocation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobLocation  $jobLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobLocation $jobLocation)
    {
        $request->validate([
            'name'        => 'required|alpha_num|min:3|max:255|unique:job_locations,name,' . $jobLocation->id,
            'hourly_wage' => 'required|numeric|max:9999.99'
        ]);

        $jobLocation->update($request->except('_token'));

        return back()->with('success', 'Job location was updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobLocation  $jobLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobLocation $jobLocation)
    {
        $jobLocation->delete();

        return response('Success', 200);
    }
}
