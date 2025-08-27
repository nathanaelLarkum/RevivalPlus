<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
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
        'category',
    ];

    /**
     * The churches that belong to the tag.
     */
    public function churches()
    {
        return $this->belongsToMany(Church::class, 'church_tag');
    }
}
