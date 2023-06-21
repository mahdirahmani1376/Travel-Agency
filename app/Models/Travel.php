<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory;
    use UUID;

    protected $guarded = ['name','description','is_public','number_of_days','number_of_nights','slug'];
    protected $table = 'travels';

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'travel_id');
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes) => $attributes['number_of_days'] -1,
//            set: fn($value) => $value,
        );
    }
}