<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'denomination_id',
        'address',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'phone_number',
        'email',
        'website_url',
        'timezone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    /**
     * Get the denomination that this church belongs to.
     */
    public function denomination()
    {
        return $this->belongsTo(Denomination::class);
    }

    /**
     * Get all of the reviews for the church.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the events for the church.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * The amenities that belong to the church.
     */
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_church');
    }
}
