<?php

namespace App\Helpers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SalaryCalculator
{
    protected Employee $employee;
    protected Carbon $beginningOfMonth; # ex: 2020-01-01 00:00:00.0
    protected Carbon $endOfMonth; # ex: 2020-01-01 23:59:59.999999

    public function __construct(Employee $employee, Carbon $beginningOfMonth)
    {
        $this->employee = $employee;
        $this->beginningOfMonth = $beginningOfMonth;
        $this->endOfMonth = $beginningOfMonth->copy()->endOfMonth();
    }

    public function getSalary()
    {
        $attendancePerMonth = $this->getMonthlyAttendance();

        foreach($attendancePerMonth as $attendance) {

        }

        return $attendancePerMonth;
    }

    private function getMonthlyAttendance(): Collection
    {
        $this->employee->attendance()
            ->whereBetween('created_at', [
                $this->beginningOfMonth,
                $this->endOfMonth
            ])
            ->where('is_present', true)
            ->get();
    }
}
