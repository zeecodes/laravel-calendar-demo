<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    /**
     * Fields to be mass-assigned.
     *
     * @var array
     */
    protected $fillable = ['title', 'date'];

    /**
     * Fields to be guarded.
     *
     * @var array
     */
    protected $guarded = ['user_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];


    /**
     * Set the event date
     *
     * @param $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }



    /**
     * Get the user that owns the event.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
