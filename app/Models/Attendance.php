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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_present' => 'boolean',
    ];

    /**
     * The path of pictures.
     *
     * @var string
     */
    public static string $picturesPath = 'attendance/';

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

    /**
     * Get Google Map's link to show coordinates
     *
     * @return string
     */
    public function googleMapsLink(): string
    {
        $coordinates = $this->latitude . ',' . $this->longitude;

        return "https://www.google.com/maps/search/?api=1&query=${coordinates}";
    }

    /**
     * Get the path of attendance's picture
     *
     * @return string
     */
    public function getPicturePath(): string
    {
        return 'storage/' . static::$picturesPath . $this->picture;
    }
}
