<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OfficeSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'thumbnail',
        'is_open',
        'is_full_booked',
        'price',
        'duration',
        'about',
        'slug',
        'city_id',
        'rating',
        'benefits',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function photos(): HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }  
    public function benefits(): HasMany
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }
    
    // app/Models/OfficeSpace.php
    public function getRouteKeyName()
    {
        return 'slug';
    }           

}
