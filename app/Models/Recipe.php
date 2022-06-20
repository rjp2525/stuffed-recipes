<?php

namespace App\Models;

use App\Traits\UsesUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\RecipeDifficultyEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory, SoftDeletes, UsesUuids, HasSlug;

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forked_from',
        'title',
        'short_description',
        'long_description',
        'notes',
        'directions',
        'prep_time',
        'cook_time',
        'custom_time',
        'custom_time_label',
        'total_time',
        'servings',
        'yield'
    ];

    /**
     * Attributes that should be cast
     *
     * @var array
     */
    protected $casts = [
        'difficulty' => RecipeDifficultyEnum::class
    ];

    /**
     * Relationship Declarations
     */

    /**
     * Get the author for this recipe.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    /**
     * Get the list of "forked" or cloned recipes based off this one.
     *
     * @return HasMany
     */
    public function forks(): HasMany
    {
        return $this->hasMany(Recipe::class, 'forked_from');
    }

    /**
     * Retrieve the original recipe from a forked version.
     *
     * @return BelongsTo
     */
    public function original(): BelongsTo
    {
        return $this->belongsTo(Recipe::class, 'forked_from');
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
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(60)
            ->usingSeparator('-')
            ->doNotGenerateSlugsOnUpdate()
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
