<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'icon_svg',
    ];

    /**
     * The churches that have this amenity.
     */
    public function churches()
    {
        return $this->belongsToMany(Church::class, 'amenity_church');
    }
}
