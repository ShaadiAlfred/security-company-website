<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Show attendance table
     */
    public function manageAttendance(Request $request)
    {
        $pageTitle = trans('Manage Attendance');

        $attendanceQuery = Attendance::query();

        if ($request->has('date')) {
            $attendanceQuery->whereBetween('created_at', $this->parseDate($request->date));
        }

        $attendanceQuery->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc');

        $attendanceRecords = $attendanceQuery->get();

        return view('attendance.manage', [
            'pageTitle'         => $pageTitle,
            'attendanceRecords' => $attendanceRecords,
        ]);
    }

    /**
     * Download attendance spreadsheet
     */
    public function downloadAttendance(Request $request)
    {
        $dates = null;

        $fileName = 'attendance';

        if ($request->has('date') && ! is_null($request->date)) {
            $dates = $this->parseDate($request->date);

            $fileName .= '-' . $dates[0]->format('m-Y');
        }

        return Excel::download(
            new AttendanceExport(
                $this->getAttendnaceCollectionToDownload($dates)
            ),
            $fileName . '.xlsx'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function parseDate(string $date): array
    {
        $month = Carbon::createFromFormat('m-Y', $date);

        return [$month->copy()->startOfMonth(), $month->endOfMonth()];
    }

    public function getAttendnaceCollectionToDownload(array $dates = null): Collection
    {
        $attendanceQuery = Attendance::with(['employee', 'submittedBy']);

        if (! is_null($dates)) {
            $attendanceQuery->whereBetween('created_at', $dates);
        }

        $attendanceCollection = $attendanceQuery->oldest()
                                                ->orderBy('id')
                                                ->get();

        return $attendanceCollection;
    }
}
