<?php

namespace App\Models;

use App\Traits\UsesUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory, UsesUuids, SoftDeletes, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'brand',
        'slug',
        'upc',
        'serving_size',
        'serving_size_unit'
    ];

    /**
     * Retrieve the nutrient information for this food.
     *
     * @return HasMany
     */
    public function nutrients(): HasMany
    {
        return $this->hasMany(Nutrient::class);
    }

    /**
     * Retrieve the user that added this food.
     *
     * @return BelongsTo
     */
    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Slug Configuration
     */

    /**
     * Get the options for generating the slug.
     *
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(60)
            ->usingSeparator('-')
            ->preventOverwrite();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
