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
        'country_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state_province_region',
        'postal_code',
        'latitude',
        'longitude',
        'email',
        'timezone',
        'website_url',
        'instagram_url',
        'facebook_url',
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
     * Get the denomination that owns the church.
     */
    public function denomination()
    {
        return $this->belongsTo(Denomination::class);
    }

    /**
     * Get the country that the church is in.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * The tags that belong to the church.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'church_tag');
    }

    /**
     * Get the reviews for the church.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the events for the church.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
