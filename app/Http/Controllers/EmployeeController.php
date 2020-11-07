<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = trans('All Employees');

        $employees = Employee::all();

        return view('employees.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees,
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

        return view('employees.create')->with('pageTitle', $pageTitle);
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

        Employee::create($validatedData);

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

        return view('employees.edit', [
            'pageTitle' => $pageTitle,
            'employee'  => $employee,
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

        return back()->with('success', 'Employee was updated!');
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
        $employees = Employee::get(['id', 'name']);

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
        $request->validate([
            'employeeId' => 'required',
        ]);

        try {
            $location = $this->getLocation($request->latitude, $request->longitude);

            Attendance::create([
                'employee_id'    => $request->employeeId,
                'note'           => $request->note,
                'submitted_by'   => $request->user()->id,
                'submitted_from' => $location,
                'latitude'       => $request->latitude,
                'longitude'      => $request->longitude,
            ]);

            return response('Success', 200);
        } catch (\Exception $e) {
            return response([
                'Message' => 'Failure',
                'Error' => $e->getMessage() . '. On line: ' . $e->getLine() . '. In file: ' . $e->getFile(),
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
            $location['house_number'],
            $location['road'],
            $location['suburb'],
            $location['city'],
        ];

        $location = join('، ', $location);

        return $location;
    }

    /**
     * Get validation rules
     *
     * @param int $uniqueId
     * @return array
     */
    public function getValidationRules(int $uniqueId = null): array
    {
        return [
            'name'           => 'required|max:64',
            'national_id'    => 'required|max:64|unique:employees,national_id' . ($uniqueId ? ',' . $uniqueId : ''),
            'address'        => 'required|max:128',
            'phone'          => 'required|max:64',
            'age'            => 'required|digits_between:1,3|max:255',
            'notes'          => 'max:64',
            'job_location'   => 'required|max:32',
            'section'        => 'required|max:64',
            'hired_on'       => 'required|date_format:d/m/Y',
            'status'         => 'max:1',
            '3ohda'          => 'max:16',
            'kashf_amny'     => 'max:16',
            'no3_el_mo5alfa' => 'max:64',
            'pants'          => 'max:32',
            'summer_t_shirt' => 'max:32',
            'winter_t_shirt' => 'max:32',
            'jacket'         => 'max:32',
            'shoes'          => 'max:32',
            'vest'           => 'max:32',
            'eish'           => 'max:32',
            'donk'           => 'max:32',
            'notes_2'        => 'max:32',
        ];
    }
}
