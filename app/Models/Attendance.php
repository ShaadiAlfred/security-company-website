<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Returns the user that submitted it
     */
    public function submittedBy()
    {
        return $this->belongsTo('\App\Models\User', 'submitted_by', 'id');
    }

    /**
     * Returns the employee for whom the attendance was registered
     */
    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee');
    }
}
