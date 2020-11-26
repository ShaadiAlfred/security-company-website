<?php

namespace Tests\Unit;

use App\Helpers\SalaryCalculator;
use App\Models\Employee;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class SalaryCalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        $date = Carbon::now()->startOfMonth();
        $employee = Employee::first();

        $salaryCalculator = new SalaryCalculator($employee, $date);

        dd($salaryCalculator->getSalary());

        $this->assertTrue(true);
    }
}
