<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesSalaryController extends Controller
{
    public function show()
    {
        return view('employees.salary');
    }
}
