<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\JobLocation;
use App\Models\JobShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    private function getPicturesPath(): string
    {
        return Employee::$picturesPath;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = trans('All Employees');

        $employees = Employee::all();

        $jobLocations = JobLocation::all();

        $jobShifts = JobShift::all();

        return view('employees.index', [
            'pageTitle'    => $pageTitle,
            'employees'    => $employees,
            'jobLocations' => $jobLocations,
            'jobShifts'    => $jobShifts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans('Add Employee');

        $jobLocations = JobLocation::all();

        $jobShifts = JobShift::all();

        return view('employees.create', [
          'pageTitle'    => $pageTitle,
          'jobLocations' => $jobLocations,
          'jobShifts'    => $jobShifts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules());

        $employee = Employee::create($validatedData);

        if ($request->hasFile('picture')) {
            $validatedPicture = $request->validate([
                'picture' => 'image',
            ]);

            $savedPicture = Storage::disk('public')
                                ->put($this->getPicturesPath(), $validatedPicture['picture']);

            $employee->picture = basename($savedPicture);
            $employee->save();
        }

        return back()->with('success', 'Employee was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $pageTitle = trans('Edit Employee');

        $jobLocations = JobLocation::all();

        $jobShifts = JobShift::all();

        return view('employees.edit', [
            'pageTitle'    => $pageTitle,
            'employee'     => $employee,
            'jobLocations' => $jobLocations,
            'jobShifts'    => $jobShifts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate($this->getValidationRules($employee->id));

        $employee->update($validatedData);

        if ($request->hasFile('picture')) {
            $validatedPicture = $request->validate([
                'picture' => 'image',
            ]);
            $validatedPicture = $validatedPicture['picture'];

            $newPicture = basename(Storage::disk('public')->put($this->getPicturesPath(), $validatedPicture));

            if ($employee->picture !== 'default.png') {
                Storage::disk('public')->delete($this->getPicturesPath() . $employee->picture);
            }

            $employee->picture = $newPicture;
            $employee->save();
        }

        return back()->with('success', 'Employee was updated!');
    }

    public function apiUpdate(Employee $employee, Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules($employee->id));

        $employee->update($validatedData);

        return response()->json([
            'success' => __('Employee was updated!')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response('Success', 200);
    }

    /**
     * Show form of importing excel file
     *
     * @return \Illuminate\View\View
     */
    public function showImportExcelForm(): \Illuminate\View\View
    {
        $pageTitle = trans('Import Excel Files');

        return view('employees.excel_import')->with('pageTitle', $pageTitle);
    }

    /**
     * Import excel file
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resopnse
     */
    public function storeFromExcel(Request $request)
    {
        foreach ($request->files->all() as $excelFile) {
            Excel::import(new EmployeesImport, $excelFile);
        }

        return response('Success', 200);
    }

    /**
     * Show attendance form
     *
     * @return |Illuminate\View\View
     */
    public function attendance(): \Illuminate\View\View
    {
        $pageTitle = trans('Attendance');
        $employees = Employee::get(['id', 'number', 'name']);

        return view('employees.attendance', [
            'pageTitle' => $pageTitle,
            'employees' => $employees,
        ]);
    }

    /**
     * Submit attendance
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submitAttendance(Request $request): \Illuminate\Http\Response
    {
        // TODO: save picture
        $request->validate([
            'employeeId' => 'required',
            'isPresent' => 'required',
        ]);

        try {
            $location = $this->getLocation($request->latitude, $request->longitude);

            $attendance = Attendance::create([
                'employee_id'    => $request->employeeId,
                'is_present'     => $request->boolean('isPresent'),
                'note'           => $request->note,
                'submitted_by'   => $request->user()->id,
                'submitted_from' => $location,
                'latitude'       => $request->latitude,
                'longitude'      => $request->longitude,
            ]);

            if ($request->hasFile('picture')) {
                $picture = Storage::disk('public')
                    ->put(Attendance::$picturesPath, $request->file('picture'));

                $attendance->picture = basename($picture);
                $attendance->save();
            }

            return response('Success', 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage() . '. On line: ' . $e->getLine() . '. In file: ' . $e->getFile();

            Log::error('Error in submitting attendance: ' . $errorMessage);

            return response([
                'Message' => 'Failure',
                'Error' => $errorMessage,
            ], 400);
        }

    }

    /**
     * Get location of coordinates
     *
     * @param string $latitude
     * @param string $longitude
     *
     * @return string $location
     */
    private function getLocation(string $latitude, string $longitude): string
    {
        $apiUrl = env('LOCATIONIQ_ENDPOINT');

        $response = Http::get($apiUrl, [
            'key'             => env('LOCATIONIQ_TOKEN'),
            'lat'             => $latitude,
            'lon'             => $longitude,
            'format'          => 'json',
            'accept-language' => 'ar',
        ]);

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        $location = $response->json()['address'];

        $location = [
            $location['house_number'] ?? '',
            $location['road'] ?? '',
            $location['suburb'] ?? '',
            $location['city'] ?? '',
        ];

        $location = trim(join('، ', $location), '، ');

        return $location;
    }

    /**
     * Get validation rules
     *
     * @param int $uniqueId
     * @return array
     */
    public function getValidationRules(int $exceptId = null): array
    {
        return [
            'name'        => 'required|max:64',
            'national_id' => [
                'required',
                'numeric',
                'digits_between:1,64',
                'unique:employees,national_id' . ($exceptId ? ",$exceptId" : ''),
            ],
            'number' => [
                'required',
                'numeric',
                'unique:employees,number' . ($exceptId ? ",$exceptId" : ''),
            ],
            'address'         => 'required|max:128',
            'phone'           => 'required|max:64',
            'age'             => 'required|digits_between:1,3|max:255',
            'notes'           => 'max:64',
            'job_location_id' => 'required|exists:job_locations,id',
            'job_shift_id'    => 'required|exists:job_shifts,id',
            'section'         => 'required|max:64',
            'hired_on'        => 'required|date_format:d/m/Y',
            'status'          => 'max:1',
            '3ohda'           => 'max:16',
            'kashf_amny'      => 'max:16',
            'no3_el_mo5alfa'  => 'max:64',
            'pants'           => 'max:32',
            'summer_t_shirt'  => 'max:32',
            'winter_t_shirt'  => 'max:32',
            'jacket'          => 'max:32',
            'shoes'           => 'max:32',
            'vest'            => 'max:32',
            'eish'            => 'max:32',
            'donk'            => 'max:32',
            'notes_2'         => 'max:32',
        ];
    }
}
