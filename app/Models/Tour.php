<?php

namespace App\Models;

use App\Http\Requests\TourIndexDataRequest;
use App\Traits\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['name', 'price', 'starting_date', 'ending_date', 'travel_id'];
    protected $table = 'tours';

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }

    public function scopeFilter(Builder $query,TourIndexDataRequest $request): Builder
    {
        return $query
            ->when($request->priceFrom, function (Builder $q,$request) {
                    $q->where('price', '>=', $request->priceFrom * 100);
                 })
            ->when($request->priceTo, function (Builder $q,$request) {
                    $q->where('price','<', $request->priceTo * 100);
                })
            ->when($request->dateFrom,function (Builder $q,$request) {
                $q->where('starting_date','>=',$request->dateFrom);
                })
            ->when($request->dateTo,function (Builder $q,$request) {
                $q->where('ending_date','<=',$request->dateTo);
                })
            ->when($request->sortBy && $request->sortOrder,
                function (Builder $q) use ($request){
                    $q->orderBy($request->sortBy,$request->sortOrder);
                },
                function (Builder $q) {
                    $q->orderBy('starting_date','desc');
                });
    }
}
