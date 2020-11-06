<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'hired_on',
    ];

    /**
     * The date format of $hired_on
     */
    private $hiredOnFormat = 'd/m/Y';

    /**
     * Get the date when the employee was hired
     *
     * @return \Carbon\Carbon
     */
    public function getHiredOnAttribute()
    {
        if (! is_null($this->attributes['hired_on'])) {
            return \Carbon\Carbon::make($this->attributes['hired_on'])->format($this->hiredOnFormat);
        } else {
            return null;
        }
    }

    /**
     * Set the employee's date of getting hired
     *
     * @param string|null $value
     * @return void
     */
    public function setHiredOnAttribute($value)
    {
        if (! is_null($value)) {
            $this->attributes['hired_on'] = \Carbon\Carbon::createFromFormat($this->hiredOnFormat, $value);
        } else {
            $this->attributes['hired_on'] = null;
        }
    }
}
