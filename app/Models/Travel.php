<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Travel extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['name','description','is_public','number_of_days','number_of_nights','slug'];
    protected $table = 'travels';

    protected static function booted()
    {
        static::creating(function (Travel $travel){
            $travel->slug = Str::slug($travel->name);
        });
        static::updating(function (Travel $travel){
            $travel->slug = Str::slug($travel->name);
        });
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'travel_id');
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes) => $attributes['number_of_days'] -1,
        );
    }
}
