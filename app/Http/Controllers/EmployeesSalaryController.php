<?php

namespace App\Http\Controllers;

use App\Helpers\SalaryCalculator;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesSalaryController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = trans('Salary');

        if ($request->has('date')) {
            $date = Carbon::createFromFormat('m-Y', $request->date)->startOfMonth();
            $employees = $this->getEmployeesWithTheirSalary($date);
        } else {
            $employees = $this->getEmployeesWithTheirSalary();
        }


        return view('employees.salary.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees,
        ]);
    }

    protected function getEmployeesWithTheirSalary(Carbon $beginningOfMonth = null)
    {
        if (is_null($beginningOfMonth)) {
            $beginningOfMonth = Carbon::now()->startOfMonth();
        }

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $salaryCalculator = new SalaryCalculator($employee, $beginningOfMonth);
            $employee->salary = $salaryCalculator->getSalary();
        }

        return $employees;
    }
}
