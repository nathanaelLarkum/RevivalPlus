<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'church_id',
        'event_type_id',
        'day_of_week',
        'start_time',
        'end_time',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'day_of_week' => 'integer',
    ];

    /**
     * Get the church that this event belongs to.
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    /**
     * Get the type of this event.
     */
    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }
}
