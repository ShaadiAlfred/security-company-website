<?php

namespace App\Helpers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\JobShift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SalaryCalculator
{
    protected Employee $employee;
    protected float $hourlyWage;
    protected JobShift $jobShift;
    protected Carbon $jobShiftStartTime;
    protected Carbon $jobShiftEndTime;
    protected Carbon $beginningOfMonth; # ex: 2020-01-01 00:00:00.0
    protected Carbon $endOfMonth; # ex: 2020-01-01 23:59:59.999999
    protected float $salary = 0.0;

    public function __construct(Employee $employee, Carbon $beginningOfMonth)
    {
        $this->employee = $employee;
        $this->jobShift = $employee->job_shift;
        $this->hourlyWage = $employee->job_location->hourly_wage;

        $this->jobShiftStartTime = $this->jobShift->start->copy();
        $this->jobShiftEndTime = $this->jobShift->end->copy();

        $this->beginningOfMonth = $beginningOfMonth;
        $this->endOfMonth = $beginningOfMonth->copy()->endOfMonth();
    }

    public function getSalary()
    {
        $attendancePerMonth = $this->getMonthlyAttendance();

        $previousAttendanceTime = new Carbon();

        $setToTheBeginningOfTheShift = true;

        foreach ($attendancePerMonth as $attendanceInstance) {
            $attendanceInstanceTime = $attendanceInstance->created_at;

            $this->setShiftDatesToThisDay($attendanceInstanceTime);

            if ($setToTheBeginningOfTheShift) {
                $previousAttendanceTime->setDateTimeFrom($this->jobShiftStartTime);
                $setToTheBeginningOfTheShift = false;
            }

            if ($attendanceInstance->is_present) {
                $hours = $this->getRoundedHoursDiffBetweenTwoDates($attendanceInstanceTime, $previousAttendanceTime);
                $this->increaseSalary($hours);
            }

            if ($this->getRoundedHoursDiffBetweenTwoDates($attendanceInstanceTime, $this->jobShiftEndTime) === 0) {
                $setToTheBeginningOfTheShift = true;
            } else {
                $previousAttendanceTime->setDateTimeFrom($attendanceInstanceTime);
            }

        }

        return $this->salary;
    }

    protected function getMonthlyAttendance(): Collection
    {
        return $this->employee->attendance()
                              ->whereBetween('created_at', [
                                  $this->beginningOfMonth,
                                  $this->endOfMonth
                              ])
                              ->get();
    }

    protected function increaseSalary(int $hours = null): void
    {
        if (is_null($hours)) {
            $hours = $this->timeIntervalBetweenEachCheck;
        }

        $this->salary += $hours * $this->hourlyWage;
    }

    protected function getRoundedHoursDiffBetweenTwoDates(Carbon $firstDate, Carbon $secondDate): int
    {
        return round($firstDate->floatDiffInHours($secondDate));
    }

    protected function setShiftDatesToThisDay(Carbon $day): void
    {
        $this->jobShiftStartTime->setDateFrom($day);
        $this->jobShiftEndTime->setDateFrom($day);
    }
}
