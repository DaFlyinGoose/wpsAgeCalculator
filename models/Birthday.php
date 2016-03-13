<?php
namespace Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Birthday
 * A model for use with Eloquent to handle creating, modifying and accessing birthday records
 * @package Models
 */
class Birthday extends Model
{
    /**
     * Calculates the difference between the current time and the dob in this
     * record. As a bit of extra complexity it also calculates how many days
     * in the absence of months
     *
     * @return bool|\DateInterval
     */
    public function scopeDiff()
    {
        $now = Carbon::create();
        $diff = $now->diff($this->dob);

        // Calculate how many days since the last year
        $days = $now->diffInDays($this->dob);
        $days = $days - (($diff->y * 365) + floor($diff->y / 4));
        $diff->daysIncludingMonths = $days;

        return $diff;
    }

    /**
     * Eloquent likes to receive the dob attribute in a DateTime object but doesn't
     * like to return it in this format, this mutator just ensures consistence
     *
     * @param $value
     * @return Carbon
     */
    public function getDobAttribute($value)
    {
        if (is_string($value)) {
            return new Carbon($value);
        }

        return $value;
    }

    /**
     * Overwriting an inherited method to stop eloquent trying to save an updated_at
     * value. This table doesn't need/have an updated_at field.
     * @param $value
     */
    public function setUpdatedAtAttribute($value)
    {
        //
    }
}